<?php

namespace App\Http\Controllers;


use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramtaggers;

use App\Http\Taggers\follow_tagger;
use App\Http\Taggers\like_tagger;
use App\Http\Taggers\comment_tagger;
use App\Http\Taggers\unfollow_tagger;

use App\Http\Helpers\media_checks;
use App\Http\Helpers\tagger_checks;

use App\Http\Controllers\Traits\dbCalls;
use App\Http\Controllers\Traits\dbTraits;
use App\Http\Controllers\Traits\userTraits;

class smartController extends Controller
{

    // Use Traits
    use dbTraits;
    use userTraits;

    // IntagramAPI Object
    public $ig;

    public $currentUser;

    public $timeline;

    public $single_response;

    public $comment_override = 0;

    public $rate_delay = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        set_time_limit(30);
        date_default_timezone_set('UTC');

        $db = [
            env('DB_CONNECTION', 'mysql'),
            'localhost',
            env('DB_DATABASE', 'instagram_api'),
            env('DB_USERNAME', 'root'),
            env('DB_PASSWORD', '')
        ];

        // Create new instance of Instagram API Object.
        $this->ig = new \InstagramAPI\Instagram(
            env('INSTAGRAM_DEBUG', true),
            env('INSTAGRAM_TRUNCATED', false), $db);

        // API Call 1
        $this->ig->setUser(env('INSTAGRAM_USERNAME', ''), env('INSTAGRAM_PASSWORD', ''));

        // API Call 2
        $this->ig->login();
    }




    /** Bulk add taggers
     *
     * This method is used to bulk add multiple taggers from multiple hashtags
     * into the database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function process_hashtag_feed(Request $request)
    {

            try {
                // Sleep to prevent spamming of API
                sleep($this->rate_delay);

                // API Call 1.
                $taggerfeed = $this->ig->hashtag->getfeed($request->input('hashtag'));

                // Save to whitelist DB.
                //$returnedCount = count($taggerfeed);
                // Save list of users to DB if not already in there.
                foreach ($taggerfeed->items as $tagger)
                {

                    // Check whitelist. If User is in whitelist, skip to next.
                    if(tagger_checks::is_user_in_whitelist($tagger->user->pk)){ continue; }

                    // Check not current user. If User is the currentuser, skip to next.
                    if(tagger_checks::is_user_the_currentuser($tagger->user->username)){ continue; }

                    // Check is not a private user. If they are, skip to next.
                    if(tagger_checks::is_user_private($tagger->user->is_private)){ continue; }

                    // If all checks out, save tagger to database!
                    instagramtaggers::updateOrCreate([
                            'tagger_pk' => $tagger->user->pk
                        ],
                        [
                            'username' =>       $tagger->user->username,
                            'tagger_pk' =>      $tagger->user->pk,
                            'tagger_media_pk' => $tagger->pk,
                            'userResponse' => serialize($tagger)
                        ]);

                }

            } catch (\Exception $e) {
                return response()->json($e->getMessage());
                exit(0);
            }

            // Return the number of results.
            return response()->json($taggerfeed->num_results);
    }


    /** Core processing Function
     *
     * This will process a tagger.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function process_single_tagger(Request $request){

        $this->rate_delay = ($request->input('delay')); // Set Process Rate in seconds.

        // Set initial Values
        $followResponse = ($request->input('follow')) ?: '';
        $likeResponse = ($request->input('like')) ?: '';
        $commentResponse = ($request->input('comment')) ?: '';
        $unfollowResponse = ($request->input('unfollow')) ?: '';

        // Grab Tagger from DB.
        $tagger = instagramtaggers::where('tagger_pk', $request->input('tagger_pk'))->first();

        // Checks.
        tagger_checks::check_user_exists_on_instagram($this->ig, $tagger);

        // Run Processes.
        if($request->input('follow') == 'true') {
            $followResponse = follow_tagger::process($this->ig, $tagger, $this->rate_delay);
        }

        if($request->input('like') == 'true') {
            $likeResponse = like_tagger::process($this->ig, $tagger, $this->rate_delay);
        }

        if($request->input('comment') == 'true') {
            $commentResponse = comment_tagger::process($this->ig, $tagger, $this->rate_delay);
        }

        if($request->input('unfollow') == 'true') {
            $unfollowResponse = unfollow_tagger::process($this->ig, $tagger, $this->rate_delay);
        }

        // Return Result
        return response()->json([
            'tagger'                => instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->first(),
            'database_count'        => instagramtaggers::count(),
            'database_unprocessed'  => instagramtaggers::whereNull('unfollowResponse')->count(),
            'follow_response'       => $followResponse,
            'like_response'         => $likeResponse,
            'comment_response'      => $commentResponse,
            'unfollow_response'     => $unfollowResponse
        ]);
    }

    /*
     * Batch Process Taggers.
     *
     * This is used for automation and creates the list / processes all taggers server-side.
     * Rather than have the tagger list client-side and send a request one-by-one to
     * the server.
     */
    public function batch_process_taggers(){

        $this->rate_delay = 4;

        // START BATCH CALL
        instagramcurrentuser::find(1)->first()->update(['last_batch_started' => new DateTime()]);

        // Get list of taggers - only need tagger_pk?
        $tagger_list = instagramtaggers::whereNull('followResponse')->oldest('updated_at')->limit(470)->get();

        // process each tagger.
        foreach($tagger_list as $tagger){

            // Check limit has not been gone over in last 24hours.

            // retrieve tagger data.
            $single_tagger = instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->first();

            //checks
            tagger_checks::check_user_exists_on_instagram($this->ig, $single_tagger);

            //Process
            $followResponse = follow_tagger::process($this->ig, $single_tagger, $this->rate_delay);
            $likeResponse = like_tagger::process($this->ig, $single_tagger, $this->rate_delay);
            $commentResponse = comment_tagger::process($this->ig, $single_tagger, $this->rate_delay);
            $unfollowResponse = unfollow_tagger::process($this->ig, $single_tagger, $this->rate_delay);

            // IF any responses are SPAM, cancel?
            if (substr($followResponse, 0, 4) == 'SPAM' ){ break; }
            if (substr($likeResponse, 0, 4) == 'SPAM' ){ break; }
            if (substr($commentResponse, 0, 4) == 'SPAM' ){ break; }
            if (substr($unfollowResponse, 0, 4) == 'SPAM' ){ break; }

            // Output to log?
        }

        // END BATCH CALL
        instagramcurrentuser::find(1)->first()->update(['last_batch_ended' => new DateTime()]);

        return true;

    }

    /*
     * Update last batch start / end date
    */
    public function updateBatchDate(Request $request){

        if ( $request->input('batch_start_or_end') == 'start'){
            instagramcurrentuser::find(1)->first()->update(['last_batch_started' => new DateTime()]);
        }

        if ( $request->input('batch_start_or_end') == 'end'){
            instagramcurrentuser::find(1)->first()->update(['last_batch_ended' => new DateTime()]);
        }

        return;
    }

    /*
     * Get start/ end batch datetimes
    */
    public function retrieveBatchDatetimes(){
        return response()->json([
            'start'      => instagramcurrentuser::find(1)->last_batch_started,
            'end'        => instagramcurrentuser::find(1)->last_batch_ended
        ]);
    }


    /**
     * Helper Function for the Debug screen
     *
     * Allow you to run any IG API Command with parameters and returns the result.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function debug_command(Request $request){

        $group = ($request->input('group'));
        $command = ($request->input('command'));
        $parameter1 = ($request->input('parameter1'));
        $parameter2 = ($request->input('parameter2'));

        try {
            $response = $this->ig->$group->$command($parameter1, $parameter2);
        }
        catch (\Exception $e) {
            return response()->json([$e->getMessage(), $e]);
        }
        return response()->json([$response]);

    }



    public function unserialize_this(Request $request){
        $serialised_string = $request->input('serialised_string');

        $whatIWant = substr($serialised_string, strpos($serialised_string, "--- ") + 4);

        $unserial = unserialize($whatIWant);

        return response()->json([$unserial]);
    }



    public function daily_processed_count(){

        $count = instagramtaggers::where('commented', '>=', Carbon::now()->subHours(24))->count();

        return $count;
    }


    public function daily_batch_count(){

        $lastbatch = instagramcurrentuser::find(1)->first()->last_batch_started;
        $count = instagramtaggers::where('commented', '>=', $lastbatch)->count();

        return $count;

    }




}

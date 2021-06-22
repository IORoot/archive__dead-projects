<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramlikers;
use App\instagramwhitelist;
use App\instagramtaggers;

/*
 *  DEPRECIATED CONTROLLER!
 */

class dashboardController extends Controller
{


    // IntagramAPI Object
    public $ig;

    public $currentUser;

    public $timeline;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        set_time_limit(6);
        date_default_timezone_set('UTC');

        $db = [
            env('DB_CONNECTION', 'mysql'),
            'localhost',
            env('DB_DATABASE', 'instagram_api'),
            env('DB_USERNAME', 'root'),
            env('DB_PASSWORD', '')
        ];


        $this->ig = new \InstagramAPI\Instagram(
            env('INSTAGRAM_DEBUG', false),
            env('INSTAGRAM_TRUNCATED', false), $db);

        // LOGIN

        // API Call 1
        $this->ig->setUser(env('INSTAGRAM_USERNAME', ''), env('INSTAGRAM_PASSWORD', ''));

        // API Call 2
        $this->ig->login();
    }








    /*
     * Retrieve list of all likers of latest media post.
     *
     * Using the latest DB entry of 'currentuser' (to save API calls);
     * get all likers of latest media ID. (API Call)
     * 1. Get currentuser
     * 2. Grab likers of currentuser's latest media post.
     *
     * @return object   Response Object or Error String.
     */
    public function userpostlikers()
    {
        try {
            // Retrieve the latest media ID from DB.
            $latestmediaID = instagramcurrentuser::find(1)->latestmediapk;

            // API Call 1
            $likers = $this->ig->media->getLikers($latestmediaID);

            // Send response.
            return response()->json($likers);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }


    /*
     * Retrieve list of all likers of latest media post.
     *
     * Using the latest DB entry of 'currentuser' (to save API calls);
     * get all likers of latest media ID. (API Call)
     * 1. Get currentuser
     * 2. Grab likers of currentuser's latest media post. (API Call)
     * 3. Check they're not in Whitelist
     * 4. Save list of likers to DB.
     *
     * @return object   Response Object or Error String.
     */
    public function save_userpostlikers()
    {
        try {
            // Retrieve the latest media ID from DB.
            $latestmediaID = instagramcurrentuser::find(1)->latestmediapk;

            // API Call 1
            $likers = $this->ig->media->getLikers($latestmediaID);

            // Get Whitelist
            $whitelist = instagramwhitelist::where('id' ,'>=' ,0)->pluck('whitelist_pk')->toArray();

            // Save list of users to DB if not already in there.
            foreach ($likers->users as $liker)
            {
                // If the LIKER is NOT a WHITELISTED person, save to Database.
                if ( ! in_array($liker->pk, $whitelist))
                {
                    // If liker isn't private either.
                    if ( ! $liker->is_private ) {
                        instagramlikers::updateOrCreate([
                            'username' => $liker->username,
                            'liker_pk' => $liker->pk
                        ]);
                    }
                }
            }

            // Send response.
            return 'Saved to Database!';

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }











    // Like a specific user.
    public function likelikers(Request $request){

        try {

            $liker = instagramlikers::where('liker_pk', $request->input('liker_pk'))->get();

            //return response()->json($liker[0]->liked);

            if (! $liker[0]->liked) {

                // Sleep to stop API Spamming.
                sleep(5);

                // API CALL 1 - Get user feed.
                $liker_feed = $this->ig->timeline->getUserFeed($liker[0]->liker_pk);

                // LATEST Media PK
                $liker_latest_media_pk = $liker_feed->items[0]->pk;

                if ($liker_latest_media_pk > 0){

                    // API CALL 2 - like that media item.
                    $returned_like = $this->ig->media->like($liker_latest_media_pk);

                    $now = new DateTime();

                    // UPDATE Database.
                    $db_response = instagramlikers::where('liker_pk', $liker[0]->liker_pk)
                        ->update(['liked' => $now, 'liker_media_pk' => $liker_latest_media_pk]);

                    return response()->json([$db_response, $returned_like, $liker[0]]);

                }
            }

            return 'Liker has already been liked!';


        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }


    // Like a specific user.
    public function followlikers(Request $request){

        try {

            $liker = instagramlikers::where('liker_pk', $request->input('liker_pk'))->get();

            if (! $liker[0]->followed) {

                // Sleep to stop API Spamming.
                sleep(5);

                // API CALL 1 - Follow User pk (from DB)
                $this->ig->people->follow($liker[0]->liker_pk);

                $now = new DateTime();

                // UPDATE Database.
                instagramlikers::where('liker_pk', $liker[0]->liker_pk)
                    ->update(['followed' => $now]);

                return response()->json(instagramlikers::all());
            }

            return 'Liker has already been followed!';


        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }

    // Like a specific user.
    public function unfollowlikers(Request $request){

        try {

            $liker = instagramlikers::where('liker_pk', $request->input('liker_pk'))->get();

            if ($liker[0]->followed && ! $liker[0]->unfollowed) {

                // Sleep to stop API Spamming.
                sleep(5);

                // API CALL 1 - Follow User pk (from DB)
                $this->ig->people->unfollow($liker[0]->liker_pk);

                $now = new DateTime();

                // UPDATE Database.
                instagramlikers::where('liker_pk', $liker[0]->liker_pk)
                    ->update(['unfollowed' => $now]);

                return response()->json(instagramlikers::all());
            }

            return 'Liker has already been unfollowed!';


        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }


    /*
     *   PROCESS ALL
     */



    // DANGER ! LOOPED API CALLS!
    public function likealllikers()
    {
        try {
            $all_unliked_likers_in_DB = instagramlikers::where('liked', null)->get();

            foreach ($all_unliked_likers_in_DB as $liker) {

                // Sleep to stop API Spamming.
                sleep(10);

                // API CALL 1 - Get user feed.
                $liker_feed = $this->ig->timeline->getUserFeed($liker->liker_pk);

                if ($liker_feed->num_results != 0){

                    // LATEST Media PK
                    $liker_latest_media_pk = $liker_feed->items[0]->pk;

                    // API CALL 2 - like that media item.
                    $returned_like = $this->ig->media->like($liker_latest_media_pk);

                    $now = new DateTime();

                    // UPDATE Database.
                    instagramlikers::where('liker_pk', $liker->liker_pk)
                        ->update(['liked' => $now, 'liker_media_pk' => $liker_latest_media_pk]);
                } else {

                    // UPDATE from listing because they have no images / results.
                    // Usually a spam account.
                    $now = new DateTime();

                    instagramlikers::where('liker_pk', $liker->liker_pk)
                        ->update(['liked' => $now, 'liker_media_pk' => '0000']);
                }

            }

            return 'Liked all likers.';


        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }

    // DANGER ! LOOPED API CALLS!
    public function followalllikers()
    {
        try {
            $all_unfollowed_likers_in_DB = instagramlikers::where('followed', null)->get();

            foreach ($all_unfollowed_likers_in_DB as $liker) {

                // Sleep to stop API Spamming.
                sleep(10);

                // API CALL 1 - Follow User pk (from DB)
                $this->ig->people->follow($liker->liker_pk);

                $now = new DateTime();

                // UPDATE Database.
                instagramlikers::where('liker_pk', $liker->liker_pk)
                    ->update(['followed' => $now]);

            }

            return 'Followed all likers.';


        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }

    // DANGER ! LOOPED API CALLS!
    public function unfollowalllikers()
    {
        try {
            $all_followed_likers_in_DB = instagramlikers::whereNotNull('followed')->whereNull('unfollowed')->get();

            foreach ($all_followed_likers_in_DB as $liker) {

                // Sleep to stop API Spamming.
                sleep(10);

                // API CALL 1 - Follow User pk (from DB)
                $this->ig->people->unfollow($liker->liker_pk);

                $now = new DateTime();

                // UPDATE Database.
                instagramlikers::where('liker_pk', $liker->liker_pk)
                    ->update(['unfollowed' => $now]);

            }

            return 'UNFollowed all likers.';


        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }


    // DANGER ! LOOPED API CALLS!
    public function delayedunfollow(Request $request)
    {
        try {

            // Get users from DB
            $all_followed_likers_in_DB = instagramlikers::whereNotNull('followed')->whereNull('unfollowed')->get();

            // Check that there are results!
            if ($all_followed_likers_in_DB) {

                foreach ($all_followed_likers_in_DB as $liker) {

                    // Find how long they've been followed.
                    $followed_datetime = Carbon::createFromFormat('Y-m-d H:i:s', $liker->followed);

                    // If the follower is old enough.
                    if (Carbon::now()->diffInMinutes($followed_datetime) > $request->input('delay')) {

                        // Sleep to stop API Spamming.
                        sleep(10);

                        // API CALL 1 - UNFollow User pk (from DB)
                        $this->ig->people->unfollow($liker->liker_pk);

                        $now = new DateTime();

                        // UPDATE Database.
                        instagramlikers::where('liker_pk', $liker->liker_pk)
                            ->update(['unfollowed' => $now]);

                    } // IF

                } // FOREACH

                return 'Unfollowed complete.';
            } // IF

            return 'No FOLLOWERS to unfollow yet.';

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }

    }


}

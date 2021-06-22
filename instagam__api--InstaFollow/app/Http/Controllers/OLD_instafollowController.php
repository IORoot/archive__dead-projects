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
use App\instagramcomments;

use App\Http\Controllers\Traits\dbTraits;

/*
 * DEPRECIATED OLD CONTROLLER
 */

class instafollowController extends Controller
{

    // Use Database-Call Traits
    use dbTraits;

    // IntagramAPI Object
    public $ig;

    public $currentUser;

    public $timeline;

    public $single_response;

    public $comment_override = 0;

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



    /** gettag()
     *
     * Requests the current Instagram feed for the given input tag.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function gettag(Request $request)
    {
        $feed = $this->ig->hashtag->getfeed($request->input('tag'));

        return response()->json($feed);
    }


    /** Save the retrieved list of taggers to DB.
     *
     * Make sure the tagger has passed the following checks before saving into DB:
     * 1. Not on whitelist
     * 2. Is NOT Private
     * 3. Not Me.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function savetaggers(Request $request)
    {

        try {

            // API Call 1.
            $taggerfeed = $this->ig->hashtag->getfeed($request->input('tag'));

            // Get Whitelist
            $whitelist = instagramwhitelist::where('id' ,'>=' ,0)->pluck('whitelist_pk')->toArray();

            // Save to whitelist DB.
            // Save list of users to DB if not already in there.
            foreach ($taggerfeed->items as $tagger)
            {

                // If the TAGGER is NOT a WHITELISTED person, save to Database.
                if ( ! in_array($tagger->user->pk, $whitelist))
                {
                    // If liker isn't private either.
                    if ( ! $tagger->user->is_private ) {

                        // Not user!
                        if ($tagger->user->username != env('INSTAGRAM_USERNAME', ''))
                        {
                            instagramtaggers::updateOrCreate([
                                'tagger_pk' => $tagger->user->pk
                            ],
                                [
                                    'username' => $tagger->user->username,
                                    'tagger_pk' => $tagger->user->pk,
                                    'tagger_media_pk' => $tagger->pk,
                                    'userResponse' => serialize($tagger)
                                ]);

                        }
                    }
                }
            }

            return 'Saved to Database!';

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }

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
    public function bulktaggers()
    {
        $taglist = array('parkour', 'freerunning', 'freerun', 'crossfit', 'fitfam', 'muscleup', 'weightlifting', 'health');

        foreach ($taglist as $tag){

            try {
                sleep(5);
                // API Call 1.
                $taggerfeed = $this->ig->hashtag->getfeed($tag);

                // Get Whitelist
                $whitelist = instagramwhitelist::where('id' ,'>=' ,0)->pluck('whitelist_pk')->toArray();

                // Save to whitelist DB.
                // Save list of users to DB if not already in there.
                foreach ($taggerfeed->items as $tagger)
                {

                    // If the TAGGER is NOT a WHITELISTED person, save to Database.
                    if ( ! in_array($tagger->user->pk, $whitelist))
                    {
                        // If liker isn't private either.
                        if ( ! $tagger->user->is_private ) {

                            // Not user!
                            if ($tagger->user->username != env('INSTAGRAM_USERNAME', ''))
                            {
                                instagramtaggers::updateOrCreate([
                                    'tagger_pk' => $tagger->user->pk
                                ],
                                    [
                                        'username' => $tagger->user->username,
                                        'tagger_pk' => $tagger->user->pk,
                                        'tagger_media_pk' => $tagger->pk,
                                        'userResponse' => serialize($tagger)
                                    ]);

                            }
                        }
                    }
                }

            } catch (\Exception $e) {
                echo 'Something went wrong: '.$e->getMessage()."\n";
                exit(0);
            }

        }
        return 'Saved to Database!';
    }


    /** Save new comment into DB
     *
     * Take the request comment input and save it to the database as a new comment
     * to use as a canned response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function savecomment(Request $request)
    {

        try {

            instagramcomments::updateOrCreate(
                [
                    'comment' => $request->input('comment')
                ]);

            return 'Comment saved to Database!';

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }

    }

    /*
     * Process a specific tagger
     *
     * Using the supplied 'taggerpk' ID Number, process the tagger with a:
     * 1. Follow
     * 2. Like
     * 3. Comment
     * 4. Unfollow.
     * Depending on which input field parameters have been supplied.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function process_single_tagger(Request $request)
    {

        // Get list of unfollowed taggers.
        $tagger = instagramtaggers::where('tagger_pk', $request->input('taggerpk'))->get();

        // check if person exists first!
        try {
            $this->single_response = $this->ig->people->getInfoById($tagger[0]->tagger_pk);
        } catch (\Exception $e) {
            instagramtaggers::where('tagger_pk', $tagger[0]->tagger_pk)->delete();
            return response()->json(['User not found. Deleted From DB. Stopped Processing.', $e->getMessage()]);
        }


        // Follow Tagger
        if ($request->input('follow') == 'true')
        {
            try {
                $this->single_response = $this->follow_single_tagger($tagger[0]);
            } catch (\Exception $e) {
                return response()->json(['FOLLOW FAILED.', $e->getMessage()]);
            }
        }


        // Like Tagger
        if ($request->input('like') == 'true')
        {
            try {
                $this->single_response = $this->like_single_tagger($tagger[0]);
            } catch (\Exception $e) {
                return response()->json(['LIKE FAILED.',$e->getMessage()]);
            }
        }


        // Comment Tagger
        if ($request->input('comment') == 'true')
        {
            try {
                $this->single_response = $this->comment_single_tagger($tagger[0]);
            } catch (\Exception $e) {
                return response()->json(['COMMENT FAILED.',$e->getMessage()]);
            }
        }


        // UNFollow Tagger
        if ($request->input('unfollow') == 'true')
        {
            try {
                $this->single_response .= $this->unfollow_single_tagger($tagger[0]);
            } catch (\Exception $e) {
                return response()->json(['UNFOLLOW FAILED.',$e->getMessage()]);
            }
        }


        sleep(rand(8,10));


        return response()->json(['Completed.', $this->single_response]);
    }

    /*
     * Process taggers in Database.
     *
     * This is the 'core' method to process the users that have not been 'followed' in the DB.
     * This will:
     * 1. Check for anyone not 'followed'
     * 2. Check if person is in Instagram first. (API Call)
     * 3. Follow. (API Call)
     * 4. Like. (API Call)
     * 5. Comment. (API Call)
     * 6. Unfollow. (API Call)
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse        Either an error or 'complete' message.
     */
    public function process_tagger(Request $request)
    {
        // Reset the comment_override if it has been exceeded.
        $this->comment_override = 0;

        // TODO - Need to delete anyone partially processed - potential fault with UNFOLLOWED people.

        // Get list of unfollowed taggers.
        $all_unfollowed_taggers_in_DB = instagramtaggers::whereNull('followed')->get();

        foreach ($all_unfollowed_taggers_in_DB as $tagger) {

            // check if person exists first!
            try {
                $this->ig->people->getInfoById($tagger->tagger_pk);
            } catch (\Exception $e) {
                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->delete();
                return response()->json(['User not found. Deleted From DB. Stopped Processing.', $e->getMessage()]);
            }


            // Follow Tagger
            if ($request->input('follow') == 'true')
            {
                $followresponse = $this->follow_single_tagger($tagger);
                if ($followresponse != true){
                    return response()->json($followresponse);
                }
            }


            // Like Tagger
            if ($request->input('like') == 'true')
            {
                $likeresponse = $this->like_single_tagger($tagger);
                if ($likeresponse != true){
                    return response()->json(['Unable to LIKE Media.', $likeresponse]);
                }
            }


            // Comment Tagger
            if ($request->input('comment') == 'true')
            {
                $commentresponse = $this->comment_single_tagger($tagger);
                if ($commentresponse != true) {
                    return response()->json($commentresponse);
                }
            }


            // UNFollow Tagger
            if ($request->input('unfollow') == 'true')
            {
                $unfollowresponse = $this->unfollow_single_tagger($tagger);
                if ($unfollowresponse != true){
                    return response()->json($unfollowresponse);
                }
            }


            // Slow down the rate of processing
            sleep(30);

        }

        return response()->json(['Completed. Nothing to process']);
    }



    /*
     * Follow a tagger
     *
     * Method to follow a single tagger on Instagram.
     *
     * @param string $tagger    'pk' number ID of user.
     *
     * @return \Illuminate\Http\JsonResponse       Either an error or boolean TRUE
     */
    public function follow_single_tagger($tagger)
    {
        if ($tagger->followed == null)
        {
            sleep(rand(8,10));
            $nowFollow = new DateTime();
            $followResponse = $this->ig->people->follow($tagger->tagger_pk);

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['followResponse' => serialize($followResponse)]);

            if ($followResponse->friendship_status->following == false)
            {
                return $followResponse;
            }

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['followed' => $nowFollow]);

        }

        return true;
    }


    /*
     * Unfollow a tagger
     *
     * Method to unfollow a single tagger on Instagram.
     *
     * @param string $tagger    'pk' number ID of user.
     *
     * @return \Illuminate\Http\JsonResponse       Either an error or boolean TRUE
     */
    public function unfollow_single_tagger($tagger)
    {
        if ($tagger->unfollowed == null)
        {
            sleep(rand(8,10));
            $nowUnfollow = new DateTime();

            try {
                $unfollowedResponse = $this->ig->people->unfollow($tagger->tagger_pk);
            } catch (\Exception $e) {

                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(['unfollowResponse' => serialize($e)]);

                $falseNowUnfollowed = new DateTime();
                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(['unfollowed' => $falseNowUnfollowed]);
                return $e->getMessage();
            }

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['unfollowResponse' => serialize($unfollowedResponse)]);

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['unfollowed' => $nowUnfollow]);
        }

        return true;
    }





    /*
     * Like a tagger
     *
     * Method to like a single tagger on Instagram.
     *
     * @param string $tagger    'pk' number ID of user.
     *
     * @return \Illuminate\Http\JsonResponse       Either an error or boolean TRUE
     */
    public function like_single_tagger($tagger)
    {
        if ($tagger->liked == null)
        {
            try {
                sleep(rand(8,10));
                $nowLike = new DateTime();
                $likeResponse = $this->ig->media->like($tagger->tagger_media_pk);
            } catch (\Exception $e) {

                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(['likeResponse' => serialize($e)]);

                $falseNowLike = new DateTime();
                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(['liked' => $falseNowLike]);
                return $e->getMessage();
            }

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['likeResponse' => serialize($likeResponse)]);

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['liked' => $nowLike]);
        }

        return true;
    }


    /*
     * Comment on a tagger
     *
     * Method will use the comment DB Table to get a random comment and use it on the
     * User's latest Media PK (ID).
     *
     * @param string $tagger    'pk' number ID of user.
     *
     * @return \Illuminate\Http\JsonResponse       Either an error or boolean TRUE
     */
    public function comment_single_tagger($tagger)
    {

        // Comment on Tagger
        if ($tagger->commented == null && $this->comment_override < 3)
        {
            try {
                sleep(rand(8,10));
                $nowComment = new DateTime();
                $randomComment = instagramcomments::pluck('comment')->random();

                $commentResponse = $this->ig->media->comment($tagger->tagger_media_pk, $randomComment);

                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(
                        ['commented' => $nowComment, 'comment' => $randomComment]);

            } catch (\Exception $e) {

                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(['commentResponse' => serialize($e)]);

                echo $e->getMessage();

                $falseNowComment = new DateTime('2099-01-01');
                instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                    ->update(['commented' => $falseNowComment]);

                $this->comment_override++;

                return $e->getMessage();

            }
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update(['commentResponse' => serialize($commentResponse)]);

            $this->comment_override = 0;
        }

        return true;
    }


    // Other API Methods to check out!
    // ==================================================================================

    // Functions to check
    // Discover->getPopularFeed()           -   Is this the heart icon - following feed?
    // Discover->getHomeChannelFeed()       -   Own feed?

    // Hashtag->getInfo()
    // Hashtag->search()
    // Hashtag->getFeed()
    // Hashtag->getRelated()

    // Media->getInfo()
    // Media->like()
    // Media->unlike()
    // Media->getLikedFeed()                - ? What feed is this ?
    // Media->getLikers()
    // Media->comment()
    // Media->likeComment()
    // Media->validateURL()                 - Check to see if I can post a web URL?

    // People->getInfoByName()
    // People->getInfoById()
    // People->getRecentActivityInbox()     - Details about your feed - when people like/comment/etc...
    // People->getFollowingRecentActivity() - Feed about people you follow
    // People->getFollowers()               - Get list of who a user is followed by.
    // People->getSelfFollowing()           - Get list of who you are following.
    // People->getSelfFollowers()           - Get list of your own followers.
    // People->search()                     - Search for Instagram users.
    // People->follow()
    // People->unfollow()

    // Timeline->getTimelineFeed()          - Get your "home screen" timeline feed.
    // Timeline->getUserFeed()
}

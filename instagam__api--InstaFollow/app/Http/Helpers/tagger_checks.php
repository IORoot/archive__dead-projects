<?php

namespace App\Http\Helpers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramtaggers;
use App\instagramcomments;
use App\instagramwhitelist;

class tagger_checks
{

    public function __construct()
    {
    }


    /**
     * Check to see if user is still on Instagram
     *
     * If user is NOT on instagram anymore (usually a spam account) then remove from database.
     *
     * @param $tagger_pk
     *
     * @return bool
     */
    public static function check_user_exists_on_instagram($ig, $tagger){

        try {

            $ig->people->getInfoById($tagger->tagger_pk);

        } catch (\Exception $e) {
            // If doesn't exist on Instagram anymore, delete from database.
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->delete();
            return false;
        }

        return true;

    }



    /*
     * This is a check to make sure the person is not on the whitelist.
     *
     * @param   int   $taggerpk     The Taggers ID Number.
     *
     * @return  bool                Return true or false.
     */
    public static function is_user_in_whitelist($taggerpk){

        // Get Whitelist from Database.
        $whitelist = instagramwhitelist::where('id' ,'>=' ,0)->pluck('whitelist_pk')->toArray();

        // If user PK is in the whitelist, return true.
        if (in_array($taggerpk, $whitelist)){
            return true;
        }

        return false;
    }


    /* This is to check that the user is not the current user.
     *
     * @param   string   $username  The Taggers Username.
     *
     * @return  bool                Return true or false.
     */
    public static function is_user_the_currentuser($username){

        if ($username == env('INSTAGRAM_USERNAME', '')) {
            return true;
        }

        return false;
    }



    /* This is to check that the user is not a private user because this will not allow
     * the follow or comment to happen.
     *
     * @param   string   $private_status    The Taggers privacy status.
     *
     * @return  bool                        Return true or false.
     */
    public static function is_user_private($private_status){

        if ( $private_status ) {

            return true;
        }

        return false;

    }


    /**
     * @param $tagger
     *
     * @return bool
     */
    public static function has_user_already_been_followed($tagger){

        if ($tagger->followResponse != null){

            // If Failed, update DB with response.
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'followResponse' => 'WARN - USER ALREADY FOLLOWED',
                    'followed' => new DateTime()
                ]);

            return true;
        }

        return false;

    }

    /**
     * @param $tagger
     *
     * @return bool
     */
    public static function has_user_already_been_unfollowed($tagger){

        if ($tagger->unfollowResponse != null){

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'unfollowResponse' => 'WARN - USER ALREADY UNFOLLOWED - SKIPPING UNFOLLOW',
                    'unfollowed' => new DateTime()
                ]);

            return true;
        }

        return false;

    }


    /**
     * @return bool
     */
    public static function have_we_been_flagged_as_follow_spam($tagger){

        if (instagramcurrentuser::find(1)->first()->followSpam >= 3){

            // If Failed, update DB with response.
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'followResponse' => 'WARN - IG SPAM DETECTION ON FOLLOW - SKIPPING ALL FOLLOWS',
                    'followed' => new DateTime()
                ]);

            return true;
        }

        return false;

    }

    /**
     * @return bool
     */
    public static function have_we_been_flagged_as_unfollow_spam($tagger){

        if (instagramcurrentuser::find(1)->first()->unfollowSpam >= 3){

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'unfollowResponse' => 'WARN - IG SPAM DETECTION ON UNFOLLOW - SKIPPING ALL UNFOLLOWS',
                    'unfollowed' => new DateTime()
                ]);

            return true;
        }

        return false;

    }


}
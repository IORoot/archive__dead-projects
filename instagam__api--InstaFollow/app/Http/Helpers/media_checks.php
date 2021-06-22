<?php

namespace App\Http\Helpers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramtaggers;

class media_checks
{

    public function __construct()
    {
    }


    /**
     * @param $ig
     * @param $tagger
     *
     * @return bool
     */
    public static function are_comments_disabled($ig, $tagger){

        if($ig->media->getInfo($tagger->tagger_media_pk)->items[0]->comments_disabled == null){

            return false;
        };

        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
            ->update([
                'commentResponse'   => 'WARN - COMMENTS DISABLED - SKIPPING COMMENT',
                'commented'         => new DateTime()
            ]);

        return true;

    }



    /**
     * This is to check the user has not deleted the media.
     *
     * This happens when a user uploads an image onto the hashtag feed
     * and then removes it later.
     *
     */
    public static function has_media_been_deleted($ig, $tagger){

        try {

            $ig->media->getInfo($tagger->tagger_media_pk);

        } catch (\Exception $e) {

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'likeResponse'      => 'WARN - MEDIA HAS BEEN DELETED - SKIPPING LIKE',
                    'liked'             => new DateTime(),
                    'commentResponse'   => 'WARN - MEDIA HAS BEEN DELETED - SKIPPING COMMENT',
                    'commented'         => new DateTime()
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
    public static function has_media_already_been_liked($tagger){

        if ($tagger->likeResponse != null){

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'likeResponse' => 'WARN - MEDIA POST ALREADY LIKED - SKIPPING LIKE ',
                    'liked' => new DateTime()
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
    public static function has_media_already_been_commented($tagger){

        if ($tagger->commentResponse != null){

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'commentResponse' => 'WARN - MEDIA ALREADY BEEN COMMENTED ON - SKIPPING COMMENT',
                    'followed' => new DateTime()
                ]);

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function have_we_been_flagged_as_like_spam($tagger){

        if (instagramcurrentuser::find(1)->first()->likeSpam >= 3){

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'likeResponse' => 'WARN - IG SPAM DETECTION ON LIKES - SKIPPING ALL LIKES',
                    'liked' => new DateTime()
                ]);

            return true;
        }

        return false;

    }

    /**
     * @return bool
     */
    public static function have_we_been_flagged_as_comment_spam($tagger){

        if (instagramcurrentuser::find(1)->first()->commentSpam >= 3){

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'commentResponse'   => 'WARN - IG SPAM DETECTION ON COMMENTS - SKIPPING ALL COMMENTS',
                    'commented'         => new DateTime()
                ]);

            return true;
        }

        return false;

    }

}
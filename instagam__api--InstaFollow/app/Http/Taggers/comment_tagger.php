<?php

namespace App\Http\Taggers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramtaggers;
use App\instagramcomments;

use App\Http\Helpers\media_checks;

class comment_tagger
{

    public function __construct()
    {
    }

    public static function process($ig, $tagger, $rate_delay)
    {

        /**
         * Checks
         */
        if (media_checks::has_media_already_been_commented($tagger))        { return 'WARN --- Already Commented on Media'; }
        if (media_checks::has_media_been_deleted($ig, $tagger))             { return 'WARN --- Media has been deleted'; }
        if (media_checks::are_comments_disabled($ig, $tagger))              { return 'WARN --- Comments Disabled.'; }
        if (media_checks::have_we_been_flagged_as_comment_spam($tagger))    { return 'SPAM --- Comment Spam Detected'; }

        $randomComment = instagramcomments::pluck('comment')->random();

        sleep($rate_delay);

        try {

            $commentResponse = $ig->media->comment($tagger->tagger_media_pk, $randomComment);

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                        'comment' => $randomComment
                ]);

        } catch (\Exception $e) {

            instagramcurrentuser::find(1)->increment('commentSpam', 1);

            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'commentResponse' => 'ERROR COMMENTING --- '. serialize($e->getMessage()),
                    'commented' => new DateTime()
                ]);

            return 'COMMENT FAILED';
        }

        instagramcurrentuser::find(1)->first()->update(['commentSpam' => 0]);

        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
            ->update([
                'commentResponse' => 'COMMENTED',
                'commented' => new DateTime()
            ]);

//        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
//            ->update([
//                'commentResponse' => 'COMMENTED --- '. serialize($commentResponse),
//                'commented' => new DateTime()
//            ]);

        return 'COMMENTED';

    }

}
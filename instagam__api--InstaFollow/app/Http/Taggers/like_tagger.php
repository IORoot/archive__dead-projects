<?php

namespace App\Http\Taggers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramtaggers;

use App\Http\Helpers\media_checks;

class like_tagger
{

    public function __construct()
    {
    }

    public static function process($ig, $tagger, $rate_delay)
    {

        // CHECKS
        if (media_checks::has_media_already_been_liked($tagger))        { return 'WARN --- Already been liked.'; }
        if (media_checks::has_media_been_deleted($ig, $tagger))         { return 'WARN --- Media has been removed'; }
        if (media_checks::have_we_been_flagged_as_like_spam($tagger))   { return 'SPAM --- Like Spam Detected'; }

        // Spam Rate Delay
        sleep($rate_delay);

        try {
            // Follow User and get response.
            $likeResponse = $ig->media->like($tagger->tagger_media_pk);
        } catch (\Exception $e) {

            instagramcurrentuser::find(1)->increment('likeSpam', 1);

            // If Failed, update DB with response and date.
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'likeResponse' => 'ERROR LIKE --- '. serialize($e->getMessage()),
                    'liked' => new DateTime('2099-01-01')
                ]);

            return 'LIKE FAILED';

        }

        instagramcurrentuser::find(1)->first()->update(['likeSpam' => 0]);

        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->update([
            'likeResponse' => 'LIKED',
            'liked' => new DateTime()
        ]);
//        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->update([
//            'likeResponse' => 'LIKED --- '. serialize($likeResponse),
//            'liked' => new DateTime()
//        ]);

        // Return JSON object.
        return 'LIKED';

    }

}
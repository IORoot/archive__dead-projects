<?php

namespace App\Http\Taggers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramcurrentuser;
use App\instagramtaggers;

use App\Http\Helpers\tagger_checks;

class unfollow_tagger
{

    public function __construct()
    {
    }

    public static function process($ig, $tagger, $rate_delay)
    {

        // CHECKS
        if (tagger_checks::has_user_already_been_unfollowed($tagger))           { return 'WARN --- already been followed.'; }
        if (tagger_checks::have_we_been_flagged_as_unfollow_spam($tagger))      { return 'SPAM --- Unfollow Spam Detected'; }

        // Spam Rate Delay
        sleep($rate_delay);

        try {

            // Follow User and get response.
            $unfollowedResponse = $ig->people->unfollow($tagger->tagger_pk);

        } catch (\Exception $e) {

            instagramcurrentuser::find(1)->increment('unfollowSpam', 1);

            // If Failed, update DB with response.
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'unfollowResponse' => 'ERROR UNFOLLOW --- '. serialize($e->getMessage()),
                    'unfollowed' => new DateTime('2099-01-01')
                ]);

            return 'UNFOLLOW FAILED';

        }

        instagramcurrentuser::find(1)->first()->update(['unfollowSpam' => 0]);

        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->update([
            'unfollowResponse' => 'UNFOLLOWED',
            'unfollowed' => new DateTime()
        ]);
//        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->update([
//            'unfollowResponse' => 'UNFOLLOWED --- '. serialize($unfollowedResponse),
//            'unfollowed' => new DateTime()
//        ]);

        return 'UNFOLLOWED';

    }

}
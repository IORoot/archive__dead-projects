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

class follow_tagger
{

    public function __construct()
    {
    }


    /**
     * Core Process for following a tagger
     *
     * This will do the following processes:
     * 1. Get the tagger from DB.
     * 2. Check if tagger hasn't been followed already.
     * 3. Check they're on instagram
     * 4. Follow them
     * 5. Update DB with new data
     * 6. Get updated DB row.
     * 7. Return Response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function process($ig, $tagger, $rate_delay)
    {

        // CHECKS
        if (tagger_checks::has_user_already_been_followed($tagger))         { return 'WARN --- already been followed.'; }
        if (tagger_checks::have_we_been_flagged_as_follow_spam($tagger))    { return 'SPAM --- Follow Spam Detected'; }


        // Follow User and get response.
        sleep($rate_delay);

        try {

            $followResponse = $ig->people->follow($tagger->tagger_pk);

        } catch (\Exception $e) {

            instagramcurrentuser::find(1)->increment('followSpam', 1);

            // If Failed, update DB with response.
            instagramtaggers::where('tagger_pk', $tagger->tagger_pk)
                ->update([
                    'followResponse' => '{ERROR FOLLOW --- , '. serialize($e->getMessage()) .'}',
                    'followed' => new DateTime('2099-01-01')
                ]);

            return 'ERROR - FOLLOW FAILED';
        }

        // Reset Spam Counter.
        instagramcurrentuser::find(1)->first()->update(['followSpam' => 0]);

        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->update([
            'followResponse' => 'FOLLOWED',
            'followed' => new DateTime()
        ]);

//        instagramtaggers::where('tagger_pk', $tagger->tagger_pk)->update([
//            'followResponse' => 'FOLLOWED --- '. serialize($followResponse),
//            'followed' => new DateTime()
//        ]);

        // Return JSON object.
        return 'FOLLOWED';

    }

}
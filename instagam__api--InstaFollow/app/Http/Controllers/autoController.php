<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\instagramtaggers;

use App\Http\Controllers\smartController;
use App\Http\Controllers\hashtagController;

class autoController extends Controller
{

    /** Scheduled Auto Bulk add taggers
     *
     * This method is used to bulk add multiple taggers from multiple hashtags
     * into the database. Runs from the scheduler. (App/Console/Kernel.php)
     *
     * @return string
     */
    public function auto_process_hashtag_feed()
    {

        // Get all hashtags.
        $allhashtags = app('App\Http\Controllers\hashtagController')->retrieveAllHashtags();

        // Create internal request & process all hashtags
        foreach($allhashtags as $hashtag){
            $request = Request::create('/processhashtagfeed', 'GET', array( 'hashtag' => $hashtag->value) );
            $response = app()->handle($request);
        }

        return;
    }


}

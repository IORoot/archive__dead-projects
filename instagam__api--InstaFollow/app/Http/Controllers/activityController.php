<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;

use App\instagramactivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activityController extends Controller
{

    // IntagramAPI Object
    public $ig;

    public $rate_delay = 10;

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

        // Create new instance of Instagram API Object.
        $this->ig = new \InstagramAPI\Instagram(
            env('INSTAGRAM_DEBUG', true),
            env('INSTAGRAM_TRUNCATED', false), $db);

        // API Call 1
        $this->ig->setUser(env('INSTAGRAM_USERNAME', ''), env('INSTAGRAM_PASSWORD', ''));

        // API Call 2
        $this->ig->login();
    }


    public function process_latest_activity()
    {

        try {
            // Sleep to prevent spamming of API
            sleep($this->rate_delay);

            // API Call 1.
            $recent_activity = $this->ig->people->getRecentActivityInbox();

            // Process each activity item.
            foreach ($recent_activity->new_stories as $tagger)
            {

                // If all checks out, save tagger to database!
                instagramactivity::updateOrCreate([
                    'mediapk' => $tagger->args->profile_id
                ],
                    [
                        'userpk'                => $tagger->pk,
                        'counttype'             => serialize($tagger->counts),
                        'commentpk'             => $tagger->args->comment_id,
                        'commenttext'           => $tagger->args->text,
                        'activitytimestamp'     => $tagger->args->timestamp,
                        'activitydate'          => Carbon::createFromTimestamp($tagger->args->timestamp)->toDateTimeString(),
                        'activityday'           => Carbon::createFromTimestamp($tagger->args->timestamp)->format('N'),
                        'activityhour'          => Carbon::createFromTimestamp($tagger->args->timestamp)->format('H'),
                        'activityseconds'       => Carbon::createFromTimestamp($tagger->args->timestamp)->format('i')
                    ]);

            }

            // Process each activity item.
            foreach ($recent_activity->old_stories as $oldtagger)
            {

                // If all checks out, save tagger to database!
                instagramactivity::updateOrCreate([
                    'mediapk' => $oldtagger->args->profile_id
                ],
                    [
                        'userpk'                => $oldtagger->pk,
                        'counttype'             => serialize($oldtagger->counts),
                        'commentpk'             => $oldtagger->args->comment_id,
                        'commenttext'           => $oldtagger->args->text,
                        'activitytimestamp'     => $oldtagger->args->timestamp,
                        'activitydate'          => Carbon::createFromTimestamp($oldtagger->args->timestamp)->toDateTimeString(),
                        'activityday'           => Carbon::createFromTimestamp($oldtagger->args->timestamp)->format('N'),
                        'activityhour'          => Carbon::createFromTimestamp($oldtagger->args->timestamp)->format('H'),
                        'activityseconds'       => Carbon::createFromTimestamp($oldtagger->args->timestamp)->format('i')
                    ]);

            }

        } catch (\Exception $e) {
            return response()->json($e);
            exit(0);
        }

        // Return the number of results.
        return response()->json($recent_activity);

    }


    public function get_latest_stats(Request $request)
    {


        $stats = DB::table('instagramactivity')->select('activityday', 'activityhour', 'activityseconds','commenttext')->get();

        $newstat = $stats->map(function($i) use ($request) {
            $converted = array_values((array)$i);

            if (strpos($converted[3], $request->input('reporttype')) ){

                return array(
                    "x" => (int)$converted[0],
                    "y" => $converted[1] . '.' . $converted[2]
                );
            } else {
                return;
            }


        });

        return response()->json($newstat);
    }

}

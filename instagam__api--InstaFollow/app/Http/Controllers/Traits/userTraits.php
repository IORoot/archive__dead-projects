<?php
namespace App\Http\Controllers\Traits;

use App\instagramcurrentuser;
use App\instagramwhitelist;

trait userTraits {


    /*
     * Basic Current User details.
     *
     * @return Object   UserObject is returned or Error String.
     */
    public function userdetails()
    {
        try {
            // API Call 1
            $this->currentUser = $this->ig->account->getCurrentUser();

            return response()->json($this->currentUser->user);
        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }


    /*
     * Get current user details
     *
     * Uses two API Calls. One to call the user account details and obtain the
     * User PK number. The second is to use that PK Number to obtain the users
     * Timeline feed.
     *
     * @return object   Response Object or Error String.
     */
    public function userposts()
    {
        try {
            // API Call 1 - Get current user.
            $currentuserid = $this->ig->account->getCurrentUser()->user;

            // API Call 2 - Get user timeline (media details)
            $timeline = $this->ig->timeline->getUserFeed($currentuserid->pk);

            // Return the first timeline media item.
            return response()->json($timeline->items[0]);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }

    /*
     * Get current user details + Save details to the Database.
     *
     * Uses two API Calls. One to call the user account details and obtain the
     * User PK number. The second is to use that PK Number to obtain the users
     * Timeline feed.
     *
     * @return object   Response Object or Error String.
     */
    public function save_userposts()
    {
        try {
            // API Call 1 - Get current user.
            $currentuserid = $this->ig->account->getCurrentUser()->user;

            // API Call 2 - Get user timeline (media details)
            $timeline = $this->ig->timeline->getUserFeed($currentuserid->pk);

            // Persist these details to the DB.
            instagramcurrentuser::updateOrCreate([
                'id'                => 1,
                'pk'                => $currentuserid->pk,
                'username'          => $currentuserid->username
            ],
                [
                    'latestmediapk'     => $timeline->items[0]->pk,
                    'mediatimestamp'    => $timeline->items[0]->taken_at
                ]);

            // Return the first timeline media item.
            return 'Saved to Database!';

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }

    /*
     * Retrieve list of all users the currentuser follows.
     *
     * Create a 'whitelist' of all users the currentuser follows. (API Call)
     *
     * @return object   Response Object or Error String.
     */
    public function whitelist()
    {
        try {

            // API Call 1.
            $whitelist = $this->ig->people->getSelfFollowing();

            return response()->json($whitelist);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }

    }


    /*
    * Retrieve list of all users the currentuser follows. Save list to DB.
    *
    * Create a 'whitelist' of all users the currentuser follows.
    * 1. Call API For list of people following.
    * 2. Use list to save to DB.
    *
    * @return object   Response Object or String.
    */
    public function save_whitelist()
    {
        try {

            // API Call 1.
            $whitelist = $this->ig->people->getSelfFollowing();

            // Save to whitelist DB.
            // Save list of users to DB if not already in there.
            foreach ($whitelist->users as $following)
            {
                instagramwhitelist::updateOrCreate([
                    'username' => $following->username,
                    'whitelist_pk' => $following->pk
                ]);
            }

            return 'Saved to Database!';

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
    }
}
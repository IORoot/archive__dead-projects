<?php

namespace App\Http\Controllers;

use App\instafollowuser;
use App\instafollowsettings;
use App\instagramcomments;
use Illuminate\Http\Request;

class settingsController extends Controller
{


    /**
     * Show the application dashboard home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');

    }

    /**
     * Update App User and Password.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUserDetails(Request $request)
    {
        if (!$request->input('username') || !$request->input('password')){ return 'Missing Details'; }

        $this->setEnvironmentValue('INSTAGRAM_USERNAME', $request->input('username'));
        $this->setEnvironmentValue('INSTAGRAM_PASSWORD', $request->input('password'));

        return 'Stored Credentials';
    }



    /*
     * Used to update the ENV variables for Instagram API. Means the PASSWORD isn't stored anywhere.
     */
    public function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env($envKey);

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }


    /*
     * Returns the App Settings.
     */
    public function retrieveAppSettings()
    {
        return instafollowsettings::first();
    }


    /*
     * Update the App Settings
     */
    public function updateAppSettings(Request $request)
    {
        if ( !$request->input('max_seq_follows') ||
             !$request->input('max_seq_unfollows') ||
             !$request->input('max_seq_comments') ||
             !$request->input('max_seq_likes') ||
             !$request->input('max_daily_process') ||
             !$request->input('api_pause')
        ){ return 'Missing Settings'; }

        instafollowsettings::first()->update([
            'max_seq_follows'   => $request->input('max_seq_follows'),
            'max_seq_unfollows' => $request->input('max_seq_unfollows'),
            'max_seq_comments'  => $request->input('max_seq_comments'),
            'max_seq_likes'     => $request->input('max_seq_likes'),
            'max_daily_process' => $request->input('max_daily_process'),
            'api_pause'         => $request->input('api_pause')
        ]);

        return 'Settings Updated';

    }


    /*
     * Returns the Comments.
     */
    public function retrieveAllComments()
    {
        return instagramcomments::all();
    }

    /*
     * Delete a Comment.
     */
    public function deleteComment(Request $request)
    {
        if (!$request->input('comment_id')){ return 'Missing Comment ID.'; }

        instagramcomments::find($request->input('comment_id'))->delete();

        return 'Comment Deleted';
    }


    /*
     * Add A Comment
     */
    public function addComment(Request $request)
    {
        if (!$request->input('new_comment')){ return 'Missing Comment. Please Enter a New Comment.'; }

        instagramcomments::updateOrCreate(['comment' => $request->input('new_comment')],
        [ 'comment' => $request->input('new_comment') ]);

        return 'Comment Added';
    }




}

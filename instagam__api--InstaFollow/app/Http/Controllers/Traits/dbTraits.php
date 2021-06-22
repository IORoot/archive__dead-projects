<?php
namespace App\Http\Controllers\Traits;

use App\instagramcurrentuser;
use App\instagramtaggers;
use App\instagramlikers;
use App\crontab;

trait dbTraits {

    /**
     * Retrieve and return ALL taggers from the database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_all_tagger_list()
    {
        return response()->json(instagramtaggers::all());
    }



    /**
     * Retrieve only the taggers who have NOT been unfollowed.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_unfollowed_tagger_list()
    {
        return response()->json([
            'taggers'               => instagramtaggers::whereNull('unfollowResponse')->oldest('updated_at')->limit(500)->get(),
            'database_count'        => instagramtaggers::count(),
            'database_unprocessed'  => instagramtaggers::whereNull('unfollowResponse')->count(),
            'commentSpam'           => instagramcurrentuser::find(1)->first()->commentSpam,
            'likeSpam'              => instagramcurrentuser::find(1)->first()->likeSpam,
            'followSpam'            => instagramcurrentuser::find(1)->first()->followSpam,
            'unfollowSpam'          => instagramcurrentuser::find(1)->first()->unfollowSpam
        ]);
    }


    /**
     * Retrieve only the taggers who have NOT been unfollowed, but followed.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_followed_not_unfollowed_tagger_list()
    {
        return response()->json([
            'taggers'               => instagramtaggers::whereNull('unfollowResponse')->whereNotNull('followResponse')->get(),
            'database_count'        => instagramtaggers::count(),
            'database_unprocessed'  => instagramtaggers::whereNull('unfollowResponse')->count(),
            'commentSpam'           => instagramcurrentuser::find(1)->first()->commentSpam,
            'likeSpam'              => instagramcurrentuser::find(1)->first()->likeSpam,
            'followSpam'            => instagramcurrentuser::find(1)->first()->followSpam,
            'unfollowSpam'          => instagramcurrentuser::find(1)->first()->unfollowSpam
        ]);
    }



    /*
     * Retrieve all 'likers' in the DB
     *
     * list of ALL likers in 'instagramlikers' table.
     *
     * @return object   Response Object.
     */
    public function likersfromdb()
    {
        $all_likers_in_DB = instagramlikers::all();

        return response()->json($all_likers_in_DB);
    }

    /*
     * Retrieve all 'likers' in the DB who are not 'Unfollowed'
     *
     * list of ALL likers in 'instagramlikers' table that are NOT unfollowed.
     *
     * @return object   Response Object.
     */
    public function newlikersfromdb()
    {
        $all_likers_in_DB = instagramlikers::whereNull('unfollowed')->get();

        return response()->json($all_likers_in_DB);
    }

    /*
     * Retrieve all 'likers' in the DB that have not been 'Liked' yet.
     *
     * list of ALL likers in 'instagramlikers' table that are NOT liked.
     *
     * @return object   Response Object.
     */
    public function unlikedlikersfromdb()
    {
        $unliked_likers_in_DB = instagramlikers::whereNull('liked')->get();

        return response()->json($unliked_likers_in_DB);
    }

    /*
     * Return all taggers from Database Table
     *
     * This will return a JSON Object that will display all entries in the instagramtaggers table.
     *
     * @return  object      json Response object.
     */
    public function taggersfromdb()
    {
        return response()->json(instagramtaggers::all());
    }

    /*
     * Return unfollowed taggers from Database Table
     *
     * This will return a JSON Object that will display all unfollowed entries in the
     * instagramtaggers table.
     *
     * @return  object      json Response object.
     */
    public function newtaggersfromdb()
    {
        return response()->json(instagramtaggers::whereNull('unfollowed')->get());
    }

    /*
     * Return followed, but not unfollowed taggers from Database Table
     *
     * This will return a JSON Object that will display all followed, but not
     * unfollowed entries in the instagramtaggers table.
     *
     * @return  object      json Response object.
     */
    public function followedtaggersfromdb()
    {
        return response()->json(instagramtaggers::whereNotNull('followed')->whereNull('unfollowed')->get());
    }

    /*
     * Return all pre-set comments from comment table.
     *
     * This will return a JSON Object that will display comments from the comments table.
     *
     * @return  \Illuminate\Http\JsonResponse      json Response object.
     */
    public function commentsfromdb()
    {
        return response()->json(instagramcomments::all());
    }


    /*
     * RESET Spam DB Values.
     */
    public function reset_comment_spam(){
        instagramcurrentuser::find(1)->first()->update(['commentSpam' => 0]);
        return;
    }

    public function reset_like_spam(){
        instagramcurrentuser::find(1)->first()->update(['likeSpam' => 0]);
        return;
    }

    public function reset_follow_spam(){
        instagramcurrentuser::find(1)->first()->update(['followSpam' => 0]);
        return;
    }

    public function reset_unfollow_spam(){
        instagramcurrentuser::find(1)->first()->update(['unfollowSpam' => 0]);
        return;
    }



    /*
     * Get Crontab Details
    */
    public function get_crontab_recon(){
       return crontab::where('function', 'recon')->first();
    }

    /*
     * Get Crontab Details
    */
    public function get_crontab_process(){
        return crontab::where('function', 'process')->first();
    }

}
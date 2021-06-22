<?php

namespace App\Http\Controllers;

use App\instafollowhashtags;
use Illuminate\Http\Request;

class hashtagController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function retrieveAllHashtags()
    {
        return instafollowhashtags::all();
    }

    /*
     * Delete a Comment.
     */
    public function deleteHashtag(Request $request)
    {
        if (!$request->input('hashtag_id')){ return 'Missing Hashtag ID.'; }

        instafollowhashtags::find($request->input('hashtag_id'))->delete();

        return 'Hashtag Deleted';
    }


    /*
     * Add A Comment
     */
    public function addHashtag(Request $request)
    {
        if (!$request->input('new_hashtag')){ return 'Missing Hashtag. Please Enter a New Hashtag.'; }

        instafollowhashtags::updateOrCreate(['value' => $request->input('new_hashtag')],
            [ 'value' => $request->input('new_hashtag') ]);

        return 'Hashtag Added';
    }

}

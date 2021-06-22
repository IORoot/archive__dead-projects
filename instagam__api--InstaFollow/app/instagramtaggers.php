<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagramtaggers extends Model
{
    protected $fillable = [
        'username',
        'tagger_pk',
        'tagger_media_pk',
        'followed',
        'unfollowed',
        'liked',
        'commented',
        'comment',
        'userResponse',
        'followResponse',
        'unfollowResponse',
        'likeResponse',
        'commentResponse'
    ];

    protected $table = 'instagramtaggers';
}

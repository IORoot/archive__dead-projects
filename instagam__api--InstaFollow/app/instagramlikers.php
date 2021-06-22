<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagramlikers extends Model
{
    protected $fillable = ['username', 'liker_pk', 'liker_media_pk', 'followed', 'unfollowed', 'liked', 'commented'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'instagramlikers';
}

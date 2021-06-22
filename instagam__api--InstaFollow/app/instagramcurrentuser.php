<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagramcurrentuser extends Model
{
    protected $fillable = ['id', 'pk', 'username', 'latestmediapk', 'mediatimestamp', 'commentSpam', 'likeSpam', 'followSpam', 'unfollowSpam', 'password', 'last_batch_started', 'last_batch_ended'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'instagramcurrentusers';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagramactivity extends Model
{
    protected $fillable = [
        'id',
        'mediapk',
        'userpk',
        'counttype',
        'commentpk',
        'commenttext',
        'activitytimestamp',
        'activitydate',
        'activityday',
        'activityhour',
        'activityseconds'
    ];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'instagramactivity';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instafollowhashtags extends Model
{
    protected $fillable = [
        'id',
        'value'
    ];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'hashtags';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instafollowsettings extends Model
{
    protected $fillable = [
        'id',
        'max_seq_follows',
        'max_seq_unfollows',
        'max_seq_comments',
        'max_seq_likes',
        'max_daily_process',
        'api_pause'
    ];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'settings';
}

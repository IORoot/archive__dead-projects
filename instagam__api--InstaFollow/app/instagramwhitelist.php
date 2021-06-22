<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagramwhitelist extends Model
{
    protected $fillable = ['username', 'whitelist_pk', 'id'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'instagramwhitelists';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instafollowuser extends Model
{
    protected $fillable = ['id', 'username', 'password'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'instafollowuser';
}

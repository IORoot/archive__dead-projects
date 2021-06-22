<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagramcomments extends Model
{
    protected $fillable = ['id', 'comment'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'instagramcomments';

}

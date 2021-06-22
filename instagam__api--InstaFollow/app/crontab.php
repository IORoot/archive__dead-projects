<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crontab extends Model
{
    protected $fillable = ['id', 'functions', 'timing', 'processcount'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'crontab';
}

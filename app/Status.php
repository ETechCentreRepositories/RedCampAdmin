<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //Table Name
    protected $table = 'statuses';

    //Timestamps
    public $timestamps = false;
}

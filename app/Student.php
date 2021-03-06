<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //Table Name
    protected $table = 'users';

    //Timestamps
    public $timestamps = false;
    
    public function statuses() {
        return $this->belongsTo('App\Status');
    }
}

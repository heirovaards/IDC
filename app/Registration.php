<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable= ['eventid','userid', 'status'];

    public function users()
    {
        return $this->belongsTo('App\User', 'userid', 'id');
    }

    public function events()
    {
        return $this->belongsTo('App\Event', 'eventid', 'id');
    }
}

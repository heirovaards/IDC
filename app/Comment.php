<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'userid', 'eventid', 'comment', 'rating',
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'userid', 'id');
    }

    public function events()
    {
        return $this->belongsTo('App\Event', 'eventid', 'id');
    }


}

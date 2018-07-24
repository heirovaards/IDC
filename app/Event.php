<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
//    use Searchable;
    protected $fillable=[
      'userid', 'eventdetail', 'eventdate', 'eventstate', 'eventcity', 'eventdistrict', 'eventaddress', 'eventstatus', 'eventname', 'reasons', 'poster', 'interest'
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'userid', 'id');
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("eventname", "LIKE","%$keyword%")
                    ->orWhere("eventdetail", "LIKE", "%$keyword%")
                    ->orWhere("eventstate", "LIKE", "%$keyword%")
                    ->orWhere("eventcity", "LIKE", "%$keyword%")
                    ->orWhere("eventdistrict", "LIKE", "%$keyword%")
                    ->orWhere("eventaddress", "LIKE", "%$keyword%")
                    ->orWhere("eventdate", "LIKE", "%$keyword%")
                    ->orWhere("eventdistrict", "LIKE", "%$keyword%")
                    ->orWhere("interest", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

}

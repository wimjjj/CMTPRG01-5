<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'name', 'description', 'user_id',
    ];

    public function owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function attendees(){
    	return $this->belongsToMany('App\User', 'attendees');
    }

    public function tasks(){
    	return $this->hasMany('App\Task');
    }
}

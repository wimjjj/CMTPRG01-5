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
    	return $this->belongsToMany('App\User', 'attendees')
                    ->withPivot('accepted')
                    ->wherePivot('accepted', 1);
    }

    public function invited(){
        return $this->belongsToMany('App\User', 'attendees')
                    ->withPivot('accepted')
                    ->wherePivot('accepted', 0);
    }

    public function tasks(){
    	return $this->hasMany('App\Task');
    }
}

<?php

namespace App;
use User;
use Task;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'name', 'description', 'user_id',
    ];

    public function owner(){
    	return $this->belongsTo('User');
    }

    public function attendees(){
    	return $this->belongsToMany('User', 'attendees');
    }

    public function tasks(){
    	return $this->hasMany('Task');
    }
}

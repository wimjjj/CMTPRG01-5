<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ownParties(){
        return $this->hasMany('App\Party', 'user_id');
    }

    public function attendedParties(){
        return $this->hasMany('App\Party', 'attendees');
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }
}

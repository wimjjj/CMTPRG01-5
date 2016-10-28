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

    public function isBanned(){
        return $this->access == -1;
    }

    public function ban(){
        $this->access = -1;
        $this->save();
    }

    public function grandAcces(){
        $this->access = 0;
        $this->save();
    }

    public function isAdmin(){
        return $this->access == 1;
    }

    public function makeAdmin(){
        $this->access = 1;
        $this->save();
    }

    public function ownParties(){
        return $this->hasMany('App\Party', 'user_id');
    }

    public function attendedParties(){
        return $this->belongsToMany('App\Party', 'attendees')
                    ->withPivot('accepted')
                    ->wherePivot('accepted', 1);
    }

    public function invitedParties(){
        return $this->belongsToMany('App\Party', 'attendees')
                    ->withPivot('accepted')
                    ->wherePivot('accepted', 0);
    }


    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function reports(){
        return $this->hasMany('App\Report');
    }
}

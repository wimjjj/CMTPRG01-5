<?php

namespace App;

use User;
use Party;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'description', 'party_id',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function party(){
    	return $this->belongsTo('App\Party');
    }
}

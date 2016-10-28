<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'party_id', 'message',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function party(){
    	return $this->belongsTo('App\Party');
    }
}

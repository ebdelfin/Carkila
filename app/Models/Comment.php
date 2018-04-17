<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['body' , 'owner_id', 'user_id'];


    public function user() {
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

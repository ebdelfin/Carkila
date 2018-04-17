<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [


        'price',
        'user_id',
        'owner_id',
        'booking_id',

    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function booking(){
        return $this->belongsTo('App\Models\Booking');
    }
}

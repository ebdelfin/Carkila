<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [


        'destination',
        'pickup_location',
        'start_date_time',
        'end_date_time',
        'pax',
        'status',
        'vehicle_id',
        'user_id',
        'owner_id',

    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle');
    }
}

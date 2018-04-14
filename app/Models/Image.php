<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['vehicle_id' , 'image'];

    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle');
    }
}

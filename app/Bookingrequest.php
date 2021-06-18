<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Bookingrequest extends Model
{
    //
    protected $table = 'booking_request';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'from_location',
        'to_location',
        'request_time',
        'services',
        'user_id',
        'status'
    ];
    // has user
    function user() {
        return $this->belongsTo('App\User');
    }
}

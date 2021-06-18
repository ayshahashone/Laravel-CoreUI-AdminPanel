<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Bookinginfo extends Model
{
    protected $table = 'booking_info';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'user_id',
        'driver_id',
        'cab_id',
        'pickup_address',
        'dropof_address',
        'services',
        'request_time'
    ];
}

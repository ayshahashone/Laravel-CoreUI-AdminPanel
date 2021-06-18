<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cab extends Model
{
    protected $table = 'cabs';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'cabno',
        'model',
        'cabtype'
    ];
}

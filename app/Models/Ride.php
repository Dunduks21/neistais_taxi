<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'driver_id',
        'customer_id',
        'route_start',
        'route_end',
        'distance',
        'ride_date',
        'status',
    ];

    // Automātiska datu kastēšana
    protected $casts = [
        'ride_date' => 'date',
    ];

    // Relācijas
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}


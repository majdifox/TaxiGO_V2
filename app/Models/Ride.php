<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'passenger_id',
        'driver_id',
        'reservation_date',
        'reservation_status',
        'pickup_time',
        'pickup_location',
        'dropoff_time',
        'dropoff_location',
        'ride_status',
        'ride_cost',
        'is_reviewed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reservation_date' => 'datetime',
        'pickup_time' => 'datetime',
        'dropoff_time' => 'datetime',
        'ride_cost' => 'decimal:2',
        'is_reviewed' => 'boolean',
    ];

    /**
     * Get the passenger that owns the ride.
     */
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    /**
     * Get the driver that owns the ride.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'driver_id',
        'make',
        'model',
        'year',
        'color',
        'plate_number',
        'type',
        'capacity',
        'vehicle_photo',
        'insurance_expiry',
        'registration_expiry',
    ];
}

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
        'is_active',
    ];
    protected $casts = [
        'year' => 'integer',
        'capacity' => 'integer',
        'insurance_expiry' => 'date',
        'registration_expiry' => 'date',
        'is_active' => 'boolean',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}

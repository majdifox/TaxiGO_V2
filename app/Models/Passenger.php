<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'rating',
        'total_rides',
        'preferences',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'decimal:2',
        'preferences' => 'array',
    ];

    /**
     * Get the user that owns the passenger profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rides associated with the passenger.
     */
    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}

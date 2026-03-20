<?php

// app/Models/Pincode.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $fillable = [
        'pincode',
        'office_name',
        'district',
        'state',
        'latitude',
        'longitude',
        'division',
        'region',
        'circle',
        'taluk'
    ];

    // Optional: Add distance scope
    public function scopeWithinRadius($query, $lat, $lng, $radius)
    {
        return $query->selectRaw("*, 
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) 
            + sin(radians(?)) * sin(radians(latitude)))) 
            AS distance", [$lat, $lng, $lat])
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
    }
}

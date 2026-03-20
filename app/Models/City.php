<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'state', 'slug', 'is_active'];

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'agent_serviceable_cities');
    }
}

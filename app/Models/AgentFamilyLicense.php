<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentFamilyLicense extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'full_name',
        'relationship',
        'license_number'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

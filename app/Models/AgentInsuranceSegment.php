<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInsuranceSegment extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'segment_type'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

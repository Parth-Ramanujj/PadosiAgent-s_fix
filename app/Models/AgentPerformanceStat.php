<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPerformanceStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'claims_processed',
        'claims_settled',
        'claims_amount',
        'success_rate',
        'response_time'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

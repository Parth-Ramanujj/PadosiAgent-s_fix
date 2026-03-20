<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCareerTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'event_type',
        'event_text',
        'month',
        'year',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentAchievementPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'photo_path'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProfileView extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'view_date',
        'view_count',
    ];

    protected $casts = [
        'view_date' => 'date',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

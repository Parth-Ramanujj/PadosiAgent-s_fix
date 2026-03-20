<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'segment_type',
        'primary_companies',
        'secondary_companies'
    ];

    protected $casts = [
        'primary_companies' => 'array',
        'secondary_companies' => 'array'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

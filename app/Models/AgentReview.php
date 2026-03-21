<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentReview extends Model
{
    protected $fillable = [
        'agent_id',
        'user_id',
        'reviewer_name',
        'reviewer_email',
        'reviewer_mobile',
        'rating',
        'review',
        'is_approved',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

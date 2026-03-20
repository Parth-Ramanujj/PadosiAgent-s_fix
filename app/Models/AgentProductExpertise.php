<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProductExpertise extends Model
{
    use HasFactory;

    protected $table = 'agent_product_expertise';

    protected $fillable = [
        'agent_id',
        'segment_type',
        'product_name',
        'expertise_level',
        'is_custom',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

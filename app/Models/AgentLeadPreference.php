<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentLeadPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'leads_new_business',
        'leads_portfolio_analysis',
        'portfolio_charging',
        'portfolio_fee',
        'leads_claims_support',
        'claims_charging',
        'claims_fee_amount',
        'claims_percent'
    ];

    protected $casts = [
        'leads_new_business' => 'boolean',
        'leads_portfolio_analysis' => 'boolean',
        'leads_claims_support' => 'boolean',
        'portfolio_fee' => 'decimal:2',
        'claims_fee_amount' => 'decimal:2',
        'claims_percent' => 'decimal:2'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

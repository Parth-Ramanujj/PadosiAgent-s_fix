<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'customer_name',
        'customer_email',
        'customer_mobile',
        'customer_pincode',
        'interaction_type',
        'lead_status',
        'service_type',
        'insurance_type',
        'insurance_company',
        'enquiry_requirements',
        'source_page',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

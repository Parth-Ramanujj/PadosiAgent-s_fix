<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'selected_plan',
        'registration_amount',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'payment_status',
        'starts_at',
        'expires_at',
        'status'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'registration_amount' => 'decimal:2'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}

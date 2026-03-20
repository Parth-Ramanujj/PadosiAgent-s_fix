<?php
// app/Models/Agent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'google_id',
        'email_verified_at',
        'mobile',
        'user_types',
        'pan_number', // Add this
        'license_number',
        'insurance_companies',
        'experience_range',
        'client_base',
        'portfolio_breakdown',
        'desired_services',
        'software_name', // Add this
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'payment_status',
        'registration_amount',
        'registration_type'
    ];

    protected $casts = [
        'user_types' => 'array',
        'insurance_companies' => 'array',
        'portfolio_breakdown' => 'array',
        'desired_services' => 'array',
        'email_verified_at' => 'datetime',
        'registration_amount' => 'decimal:2'
    ];
}

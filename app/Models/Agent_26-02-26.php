<?php
// app/Models/Agent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'google_id',
        'email_verified_at',
        'mobile',
        'user_types',
        'insurance_companies',
        'experience_range',
        'client_base',
        'registration_step',
        'status',
        'registration_draft'
    ];

    protected $casts = [
        'user_types' => 'array',
        'insurance_companies' => 'array',
        'email_verified_at' => 'datetime',
        'registration_draft' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->hasOne(AgentProfile::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(AgentSubscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(AgentSubscription::class)->where('status', 'active')->where('expires_at', '>', now());
    }

    public function performanceStats()
    {
        return $this->hasOne(AgentPerformanceStat::class);
    }

    public function familyLicenses()
    {
        return $this->hasMany(AgentFamilyLicense::class);
    }

    public function insuranceSegments()
    {
        return $this->hasMany(AgentInsuranceSegment::class);
    }

    public function portfolios()
    {
        return $this->hasMany(AgentPortfolio::class);
    }

    public function achievementPhotos()
    {
        return $this->hasMany(AgentAchievementPhoto::class);
    }

    public function leadPreferences()
    {
        return $this->hasOne(AgentLeadPreference::class);
    }

    public function productExpertise()
    {
        return $this->hasMany(AgentProductExpertise::class);
    }

    public function serviceableCities()
    {
        return $this->belongsToMany(City::class, 'agent_serviceable_cities');
    }

    public function careerTimelines()
    {
        return $this->hasMany(AgentCareerTimeline::class);
    }
}

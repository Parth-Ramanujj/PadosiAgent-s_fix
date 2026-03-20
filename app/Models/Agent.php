<?php
// app/Models/Agent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected static function booted()
    {
        static::saved(function ($agent) {
            // Dual-Writing Sync for User Types
            if ($agent->wasChanged('user_types') || empty(DB::table('agent_user_type')->where('agent_id', $agent->id)->count())) {
                $types = is_array($agent->user_types) ? $agent->user_types : (json_decode($agent->user_types, true) ?? []);
                $typeIds = [];
                foreach ($types as $typeSlug) {
                    if (empty($typeSlug)) continue;
                    $type = UserType::firstOrCreate(
                        ['slug' => $typeSlug],
                        ['name' => ucwords(str_replace('_', ' ', $typeSlug))]
                    );
                    $typeIds[] = $type->id;
                }
                $agent->userTypes()->sync($typeIds);
            }

            // Dual-Writing Sync for Insurance Companies
            if ($agent->wasChanged('insurance_companies') || empty(DB::table('agent_insurance_company')->where('agent_id', $agent->id)->count())) {
                $companies = is_array($agent->insurance_companies) ? $agent->insurance_companies : (json_decode($agent->insurance_companies, true) ?? []);
                $companyIds = [];
                foreach ($companies as $compName) {
                    if (empty($compName)) continue;
                    $comp = InsuranceCompany::firstOrCreate(
                        ['slug' => \Illuminate\Support\Str::slug($compName)],
                        ['name' => $compName]
                    );
                    $companyIds[] = $comp->id;
                }
                $agent->insuranceCompanies()->sync($companyIds);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userTypes()
    {
        return $this->belongsToMany(UserType::class, 'agent_user_type');
    }

    public function insuranceCompanies()
    {
        return $this->belongsToMany(InsuranceCompany::class, 'agent_insurance_company', 'agent_id', 'insurance_company_id');
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

    public function reviews()
    {
        return $this->hasMany(AgentReview::class, 'agent_id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews->where('is_approved', true)->avg('rating') ?? 0;
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews->where('is_approved', true)->count();
    }
}

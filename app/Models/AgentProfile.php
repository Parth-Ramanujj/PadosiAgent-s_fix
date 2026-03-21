<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AgentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'slug',
        'profile_photo_path',
        'display_name',
        'whatsapp',
        'languages',
        'address',
        'pan_number',
        'license_number',
        'software_name',
        'portfolio_breakdown',
        'desired_services',
        'agency_name',
        'office_address',
        'service_pincodes',
        'service_pincode', // Virtual field for form input
        'experience_years',
        'has_pos_license',
        'website_url',
        'social_links',
        'career_highlights'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            if (!$profile->slug) {
                $name = $profile->display_name ?: ($profile->agent->fullname ?? 'agent');
                $profile->slug = static::generateUniqueSlug($name);
            }
        });

        static::updating(function ($profile) {
            if ($profile->isDirty('display_name') && !$profile->isDirty('slug')) {
                $profile->slug = static::generateUniqueSlug($profile->display_name);
            }
        });
    }

    public static function generateUniqueSlug($name)
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    protected $casts = [
        'social_links' => 'array',
        'portfolio_breakdown' => 'array',
        'desired_services' => 'array',
        'has_pos_license' => 'boolean',
        'service_pincodes' => 'array'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function getProfilePhotoUrlAttribute(): ?string
    {
        $path = trim((string) ($this->profile_photo_path ?? ''));
        if ($path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $normalizedPath = ltrim($path, '/');
        if (str_starts_with($normalizedPath, 'storage/')) {
            $normalizedPath = substr($normalizedPath, strlen('storage/'));
        }

        return Storage::disk('public')->url($normalizedPath);
    }

    // Mutator to handle 'service_pincode' (singular) input from form
    // and save it into 'service_pincodes' (plural array) column
    public function setServicePincodeAttribute($value)
    {
        if ($value) {
            $this->attributes['service_pincodes'] = json_encode([$value]);
        }
    }
}

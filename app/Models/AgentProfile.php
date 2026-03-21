<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            return asset('img/avatar-icon.jpg');
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $normalizedPath = str_replace('\\', '/', ltrim($path, '/'));

        // Handle multiple historical path formats saved in DB.
        foreach (['app/public/', 'public/storage/', 'public/', 'storage/'] as $prefix) {
            if (Str::startsWith($normalizedPath, $prefix)) {
                $normalizedPath = Str::after($normalizedPath, $prefix);
                break;
            }
        }

        if ($normalizedPath !== '' && Storage::disk('public')->exists($normalizedPath)) {
            return Storage::disk('public')->url($normalizedPath);
        }

        if ($normalizedPath !== '' && file_exists(public_path($normalizedPath))) {
            return asset($normalizedPath);
        }

        if ($normalizedPath !== '' && file_exists(public_path('storage/' . $normalizedPath))) {
            return asset('storage/' . $normalizedPath);
        }

        return asset('img/avatar-icon.jpg');
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

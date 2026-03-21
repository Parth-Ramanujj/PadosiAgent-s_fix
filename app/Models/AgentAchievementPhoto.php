<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgentAchievementPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'photo_path'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        $path = trim((string) ($this->photo_path ?? ''));
        if ($path === '') {
            return asset('img/avatar-icon.jpg');
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $normalizedPath = str_replace('\\', '/', ltrim($path, '/'));

        foreach (['app/public/', 'public/storage/', 'public/', 'storage/'] as $prefix) {
            if (Str::startsWith($normalizedPath, $prefix)) {
                $normalizedPath = Str::after($normalizedPath, $prefix);
                break;
            }
        }

        // Return the storage URL directly.
        return Storage::disk('public')->url($normalizedPath);
    }
}

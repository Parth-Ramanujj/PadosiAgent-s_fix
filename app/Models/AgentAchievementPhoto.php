<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
}

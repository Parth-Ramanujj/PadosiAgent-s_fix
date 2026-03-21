<?php

namespace App\Console\Commands;

use App\Models\AgentProfile;
use App\Models\AgentAchievementPhoto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigratePhotosToCloudinary extends Command
{
    protected $signature   = 'photos:migrate-to-cloudinary';
    protected $description = 'Upload all existing local profile & achievement photos to Cloudinary and update DB paths.';

    public function handle(): int
    {
        // ── Profile photos ──────────────────────────────────────────────
        $this->info('Migrating profile photos...');

        AgentProfile::whereNotNull('profile_photo_path')
            ->whereNotLike('profile_photo_path', 'http%')
            ->each(function (AgentProfile $profile) {

                $normalized = str_replace('\\', '/', ltrim((string) $profile->profile_photo_path, '/'));
                foreach (['app/public/', 'public/storage/', 'public/', 'storage/'] as $prefix) {
                    if (Str::startsWith($normalized, $prefix)) {
                        $normalized = Str::after($normalized, $prefix);
                        break;
                    }
                }

                // Try local storage first
                if (Storage::disk('public')->exists($normalized)) {
                    $localPath = Storage::disk('public')->path($normalized);
                } else {
                    $this->warn("  [SKIP] File not found locally: {$normalized} (agent_id={$profile->agent_id})");
                    return;
                }

                try {
                    $result = cloudinary()->uploadApi()->upload($localPath, [
                        'folder'        => 'padosiagent/profiles',
                        'public_id'     => 'agent_' . $profile->agent_id . '_migrated',
                        'overwrite'     => true,
                        'resource_type' => 'image',
                    ]);

                    if (!empty($result['secure_url'])) {
                        $profile->profile_photo_path = $result['secure_url'];
                        $profile->save();
                        $this->info("  [OK] agent_id={$profile->agent_id} → {$result['secure_url']}");
                    }
                } catch (\Throwable $e) {
                    $this->error("  [FAIL] agent_id={$profile->agent_id}: " . $e->getMessage());
                    Log::error('MigratePhotosToCloudinary profile error', ['agent_id' => $profile->agent_id, 'error' => $e->getMessage()]);
                }
            });

        // ── Achievement photos ───────────────────────────────────────────
        $this->info('Migrating achievement photos...');

        AgentAchievementPhoto::whereNotLike('photo_path', 'http%')
            ->each(function (AgentAchievementPhoto $photo) {

                $normalized = str_replace('\\', '/', ltrim((string) $photo->photo_path, '/'));
                foreach (['app/public/', 'public/storage/', 'public/', 'storage/'] as $prefix) {
                    if (Str::startsWith($normalized, $prefix)) {
                        $normalized = Str::after($normalized, $prefix);
                        break;
                    }
                }

                if (Storage::disk('public')->exists($normalized)) {
                    $localPath = Storage::disk('public')->path($normalized);
                } else {
                    $this->warn("  [SKIP] File not found locally: {$normalized} (photo_id={$photo->id})");
                    return;
                }

                try {
                    $result = cloudinary()->uploadApi()->upload($localPath, [
                        'folder'        => 'padosiagent/achievements',
                        'public_id'     => 'achievement_' . $photo->agent_id . '_' . $photo->id . '_migrated',
                        'overwrite'     => true,
                        'resource_type' => 'image',
                    ]);

                    if (!empty($result['secure_url'])) {
                        $photo->photo_path = $result['secure_url'];
                        $photo->save();
                        $this->info("  [OK] photo_id={$photo->id} → {$result['secure_url']}");
                    }
                } catch (\Throwable $e) {
                    $this->error("  [FAIL] photo_id={$photo->id}: " . $e->getMessage());
                    Log::error('MigratePhotosToCloudinary achievement error', ['photo_id' => $photo->id, 'error' => $e->getMessage()]);
                }
            });

        $this->info('Migration complete!');
        return Command::SUCCESS;
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Clear all profile photo paths that are NOT Cloudinary URLs
        // (old local paths like agent/profiles/xxx.jpg that don't exist on Railway)
        DB::table('agent_profiles')
            ->whereNotNull('profile_photo_path')
            ->where('profile_photo_path', 'not like', 'http%')
            ->update(['profile_photo_path' => null]);

        // Clear all achievement photo paths that are NOT Cloudinary URLs
        DB::table('agent_achievement_photos')
            ->where('photo_path', 'not like', 'http%')
            ->delete();
    }

    public function down(): void
    {
        // Irreversible data migration
    }
};

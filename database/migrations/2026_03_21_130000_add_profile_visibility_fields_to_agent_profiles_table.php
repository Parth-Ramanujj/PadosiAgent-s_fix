<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('agent_profiles')) {
            return;
        }

        Schema::table('agent_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('agent_profiles', 'is_profile_visible')) {
                $table->boolean('is_profile_visible')->default(true);
            }

            if (!Schema::hasColumn('agent_profiles', 'show_certificates')) {
                $table->boolean('show_certificates')->default(true);
            }

            if (!Schema::hasColumn('agent_profiles', 'show_achievements')) {
                $table->boolean('show_achievements')->default(true);
            }

            if (!Schema::hasColumn('agent_profiles', 'show_reviews')) {
                $table->boolean('show_reviews')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('agent_profiles')) {
            return;
        }

        Schema::table('agent_profiles', function (Blueprint $table) {
            $drop = [];

            if (Schema::hasColumn('agent_profiles', 'show_reviews')) {
                $drop[] = 'show_reviews';
            }
            if (Schema::hasColumn('agent_profiles', 'show_achievements')) {
                $drop[] = 'show_achievements';
            }
            if (Schema::hasColumn('agent_profiles', 'show_certificates')) {
                $drop[] = 'show_certificates';
            }
            if (Schema::hasColumn('agent_profiles', 'is_profile_visible')) {
                $drop[] = 'is_profile_visible';
            }

            if (!empty($drop)) {
                $table->dropColumn($drop);
            }
        });
    }
};

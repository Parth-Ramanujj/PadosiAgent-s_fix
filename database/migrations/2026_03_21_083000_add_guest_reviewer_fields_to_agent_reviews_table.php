<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('agent_reviews')) {
            return;
        }

        Schema::table('agent_reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('agent_reviews', 'reviewer_name')) {
                $table->string('reviewer_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('agent_reviews', 'reviewer_email')) {
                $table->string('reviewer_email')->nullable()->after('reviewer_name');
            }
            if (!Schema::hasColumn('agent_reviews', 'reviewer_mobile')) {
                $table->string('reviewer_mobile', 20)->nullable()->after('reviewer_email');
            }
        });

        // Make user_id nullable to support guest reviews without account creation.
        if (Schema::hasColumn('agent_reviews', 'user_id') && DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE agent_reviews MODIFY user_id BIGINT UNSIGNED NULL');
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('agent_reviews')) {
            return;
        }

        Schema::table('agent_reviews', function (Blueprint $table) {
            if (Schema::hasColumn('agent_reviews', 'reviewer_mobile')) {
                $table->dropColumn('reviewer_mobile');
            }
            if (Schema::hasColumn('agent_reviews', 'reviewer_email')) {
                $table->dropColumn('reviewer_email');
            }
            if (Schema::hasColumn('agent_reviews', 'reviewer_name')) {
                $table->dropColumn('reviewer_name');
            }
        });
    }
};

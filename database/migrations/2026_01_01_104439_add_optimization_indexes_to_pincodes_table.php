<?php
// database/migrations/[timestamp]_add_optimization_indexes_to_pincodes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pincodes', function (Blueprint $table) {
            // 1. COMPOSITE INDEX for state+district (now safe because state is 50 chars)
            // state(50) + district(100) = 150 chars total, well under 1000 byte limit
            $table->index(['state', 'district']);

            // 2. COMPOSITE INDEX for coordinates - CRITICAL for nearby search
            $table->index(['latitude', 'longitude']);

            // 3. Optional: Single index on longitude for certain queries
            $table->index('longitude');

            // Note: 'pincode', 'state', 'district' indexes already exist from your first migration
        });
    }

    public function down(): void
    {
        Schema::table('pincodes', function (Blueprint $table) {
            // Drop the new indexes (keep original ones)
            $table->dropIndex(['state', 'district']);
            $table->dropIndex(['latitude', 'longitude']);
            $table->dropIndex(['longitude']);
        });
    }
};

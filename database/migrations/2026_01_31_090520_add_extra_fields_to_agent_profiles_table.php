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
        Schema::table('agent_profiles', function (Blueprint $table) {
            $table->string('software_name')->nullable()->after('license_number');
            $table->json('portfolio_breakdown')->nullable()->after('software_name');
            $table->json('desired_services')->nullable()->after('portfolio_breakdown');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agent_profiles', function (Blueprint $table) {
            $table->dropColumn(['software_name', 'portfolio_breakdown', 'desired_services']);
        });
    }
};

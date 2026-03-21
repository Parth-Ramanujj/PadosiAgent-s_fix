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
        if (!Schema::hasTable('user_types')) {
            Schema::create('user_types', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('insurance_companies')) {
            Schema::create('insurance_companies', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('agent_user_type')) {
            Schema::create('agent_user_type', function (Blueprint $table) {
                $table->unsignedBigInteger('agent_id')->index();
                $table->foreignId('user_type_id')->constrained('user_types')->onDelete('cascade');
                $table->primary(['agent_id', 'user_type_id']);
            });
        }

        if (!Schema::hasTable('agent_insurance_company')) {
            Schema::create('agent_insurance_company', function (Blueprint $table) {
                $table->unsignedBigInteger('agent_id')->index();
                $table->foreignId('insurance_company_id')->constrained('insurance_companies')->onDelete('cascade');
                $table->primary(['agent_id', 'insurance_company_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally empty to avoid dropping live data from safety migration rollback.
    }
};

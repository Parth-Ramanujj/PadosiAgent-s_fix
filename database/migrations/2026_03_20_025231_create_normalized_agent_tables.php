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
        // 1. User Types (for the JSON 'user_types')
        if (!Schema::hasTable('user_types')) {
            Schema::create('user_types', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('name');
                $table->timestamps();
            });
        }

        // 2. Insurance Companies (for the JSON 'insurance_companies')
        if (!Schema::hasTable('insurance_companies')) {
            Schema::create('insurance_companies', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('name');
                $table->timestamps();
            });
        }

        // 3. Pivot: Agent <-> User Type
        if (!Schema::hasTable('agent_user_type')) {
            Schema::create('agent_user_type', function (Blueprint $table) {
                $table->unsignedBigInteger('agent_id')->index(); // No constraint due to MyISAM engine on agents
                $table->foreignId('user_type_id')->constrained('user_types')->onDelete('cascade');
                $table->primary(['agent_id', 'user_type_id']);
            });
        }

        // 4. Pivot: Agent <-> Insurance Company
        if (!Schema::hasTable('agent_insurance_company')) {
            Schema::create('agent_insurance_company', function (Blueprint $table) {
                $table->unsignedBigInteger('agent_id')->index(); // No constraint due to MyISAM engine on agents
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
        Schema::dropIfExists('agent_insurance_company');
        Schema::dropIfExists('agent_user_type');
        Schema::dropIfExists('insurance_companies');
        Schema::dropIfExists('user_types');
    }
};

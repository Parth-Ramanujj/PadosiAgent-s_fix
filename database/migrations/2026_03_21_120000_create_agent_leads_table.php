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
        Schema::create('agent_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('agents')->cascadeOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_mobile', 20)->nullable();
            $table->string('customer_pincode', 10)->nullable();
            $table->string('interaction_type', 20); // call | whatsapp
            $table->string('lead_status', 20)->default('new'); // new | contacted | follow_up | closed
            $table->string('service_type')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('insurance_company')->nullable();
            $table->text('enquiry_requirements')->nullable();
            $table->string('source_page')->nullable();
            $table->timestamps();

            $table->index(['agent_id', 'created_at']);
            $table->index(['agent_id', 'lead_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_leads');
    }
};

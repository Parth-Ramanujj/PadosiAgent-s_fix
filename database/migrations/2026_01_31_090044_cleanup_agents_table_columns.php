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
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn([
                'razorpay_order_id',
                'razorpay_payment_id',
                'razorpay_signature',
                'payment_status',
                'selected_plan',
                'registration_amount',
                'registration_type',
                'portfolio_breakdown',
                'desired_services',
                'software_name',
                'license_number',
                'pan_number'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->string('payment_status')->nullable();
            $table->json('selected_plan')->nullable();
            $table->decimal('registration_amount', 10, 2)->nullable();
            $table->string('registration_type')->nullable();
            $table->json('portfolio_breakdown')->nullable();
            $table->json('desired_services')->nullable();
            $table->string('software_name')->nullable();
            $table->string('license_number')->nullable();
            $table->string('pan_number')->nullable();
        });
    }
};

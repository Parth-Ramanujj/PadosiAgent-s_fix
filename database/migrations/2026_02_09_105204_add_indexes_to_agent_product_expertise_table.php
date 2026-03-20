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
        Schema::table('agent_product_expertise', function (Blueprint $table) {
            // First, shorten the columns to ensure the index fits within MySQL's 1000-byte limit for UTF8MB4
            $table->string('segment_type', 50)->change();
            $table->string('product_name', 150)->change();

            // Index for high-performance product name searching
            $table->index('product_name');
            
            // Composite index for segment + product
            $table->index(['segment_type', 'product_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agent_product_expertise', function (Blueprint $table) {
            $table->dropIndex(['product_name']);
            $table->dropIndex(['segment_type', 'product_name']);
            
            // Restore original lengths if needed (default is usually 255)
            $table->string('segment_type', 255)->change();
            $table->string('product_name', 255)->change();
        });
    }
};

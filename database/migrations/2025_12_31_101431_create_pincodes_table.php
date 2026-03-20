<?php
// database/migrations/2025_12_31_101431_create_pincodes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // database/migrations/2025_12_31_101431_create_pincodes_table.php
    public function up()
    {
        Schema::create('pincodes', function (Blueprint $table) {
            $table->id();
            $table->string('pincode', 10)->unique();
            $table->string('office_name', 150);
            $table->string('district', 100);
            $table->string('state', 50);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->string('division', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('circle', 100)->nullable();
            $table->string('taluk', 100)->nullable();
            $table->timestamps();

            // SAFE indexes (no composite index on long strings)
            $table->index('pincode');
            $table->index('state');
            $table->index('district');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pincodes');
    }
};

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
        // Add purchase_price to carton_types table
        Schema::table('carton_types', function (Blueprint $table) {
            $table->decimal('purchase_price', 10, 2)->nullable()->after('description')->comment('Purchase price per carton in DH');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carton_types', function (Blueprint $table) {
            $table->dropColumn('purchase_price');
        });
    }
};

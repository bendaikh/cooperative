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
        Schema::table('commande_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('product_stock_id')->nullable()->after('commande_id');
            $table->foreign('product_stock_id')->references('id')->on('product_stock')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commande_tickets', function (Blueprint $table) {
            $table->dropForeign(['product_stock_id']);
            $table->dropColumn('product_stock_id');
        });
    }
};

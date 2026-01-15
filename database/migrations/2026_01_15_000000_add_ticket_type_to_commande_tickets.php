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
            $table->enum('ticket_type', ['PAPIER', 'VINELLE'])->default('PAPIER')->after('product_stock_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commande_tickets', function (Blueprint $table) {
            $table->dropColumn('ticket_type');
        });
    }
};

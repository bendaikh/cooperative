<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add ticket fields to commandes table
        Schema::table('commandes', function (Blueprint $table) {
            $table->boolean('avec_ticket')->default(false)->after('avec_joint_securite');
            $table->string('nom_marque')->nullable()->after('avec_ticket');
            $table->string('numero_autorisation')->nullable()->after('nom_marque');
            $table->unsignedBigInteger('ticket_product_stock_id')->nullable()->after('numero_autorisation');
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn(['avec_ticket', 'nom_marque', 'numero_autorisation', 'ticket_product_stock_id']);
        });
    }
};

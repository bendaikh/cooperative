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
        Schema::table('herbs', function (Blueprint $table) {
            if (!Schema::hasColumn('herbs', 'fornisseur_id')) {
                $table->foreignId('fornisseur_id')->nullable()->after('purchase_price')->constrained('fornisseurs')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('herbs', function (Blueprint $table) {
            if (Schema::hasColumn('herbs', 'fornisseur_id')) {
                $table->dropForeign(['fornisseur_id']);
                $table->dropColumn('fornisseur_id');
            }
        });
    }
};

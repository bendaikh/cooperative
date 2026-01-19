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
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('commande_type')->default('with_packaging')->after('id');
            $table->unsignedBigInteger('emballage_product_stock_id')->nullable()->after('commande_type');
            $table->unsignedBigInteger('filled_capsule_id')->nullable()->after('emballage_product_stock_id');
            $table->decimal('selling_price', 10, 2)->default(0)->after('notes');
            
            // Add foreign key for emballage_product_stock_id
            $table->foreign('emballage_product_stock_id')->references('id')->on('product_stock')->onDelete('set null');
            // Add foreign key for filled_capsule_id
            $table->foreign('filled_capsule_id')->references('id')->on('filled_capsules')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['emballage_product_stock_id']);
            $table->dropForeign(['filled_capsule_id']);
            $table->dropColumn(['commande_type', 'emballage_product_stock_id', 'filled_capsule_id', 'selling_price']);
        });
    }
};

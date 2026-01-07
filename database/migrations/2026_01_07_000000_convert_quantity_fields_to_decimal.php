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
        // Convert herb_stock_movements quantity to decimal
        if (Schema::hasTable('herb_stock_movements')) {
            Schema::table('herb_stock_movements', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }

        // Convert capsule_stock_movements quantity to decimal
        if (Schema::hasTable('capsule_stock_movements')) {
            Schema::table('capsule_stock_movements', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }

        // Convert capsules table quantity to decimal
        if (Schema::hasTable('capsules')) {
            Schema::table('capsules', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }

        // Convert product_stock quantity to decimal
        if (Schema::hasTable('product_stock')) {
            Schema::table('product_stock', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }

        // Convert stock_movements quantity to decimal
        if (Schema::hasTable('stock_movements')) {
            Schema::table('stock_movements', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }

        // Convert commandes quantity to decimal
        if (Schema::hasTable('commandes')) {
            Schema::table('commandes', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }

        // Convert filled_capsules quantity to decimal
        if (Schema::hasTable('filled_capsules')) {
            Schema::table('filled_capsules', function (Blueprint $table) {
                $table->decimal('quantity', 10, 3)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert back to integer
        if (Schema::hasTable('herb_stock_movements')) {
            Schema::table('herb_stock_movements', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }

        if (Schema::hasTable('capsule_stock_movements')) {
            Schema::table('capsule_stock_movements', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }

        if (Schema::hasTable('capsules')) {
            Schema::table('capsules', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }

        if (Schema::hasTable('product_stock')) {
            Schema::table('product_stock', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }

        if (Schema::hasTable('stock_movements')) {
            Schema::table('stock_movements', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }

        if (Schema::hasTable('commandes')) {
            Schema::table('commandes', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }

        if (Schema::hasTable('filled_capsules')) {
            Schema::table('filled_capsules', function (Blueprint $table) {
                $table->integer('quantity')->change();
            });
        }
    }
};

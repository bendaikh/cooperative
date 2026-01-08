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
        // Add carton type and price to capsules table
        Schema::table('capsules', function (Blueprint $table) {
            $table->enum('carton_type', ['A', 'B'])->default('A')->after('quantity')->comment('A=125000, B=120000');
            $table->decimal('carton_price', 10, 2)->nullable()->after('carton_type')->comment('Purchase price per carton');
        });

        // Add purchase price to herbs table
        Schema::table('herbs', function (Blueprint $table) {
            $table->decimal('purchase_price', 10, 2)->nullable()->after('source')->comment('Purchase price per unit');
        });

        // Add purchase price to product_stock table
        Schema::table('product_stock', function (Blueprint $table) {
            $table->decimal('purchase_price', 10, 2)->nullable()->after('notes')->comment('Purchase price per unit');
        });

        // Create expenses table for tracking automatic expense records
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('herbs, packaging, capsules');
            $table->foreignId('herb_id')->nullable()->constrained('herbs')->onDelete('cascade');
            $table->foreignId('product_stock_id')->nullable()->constrained('product_stock')->onDelete('cascade');
            $table->foreignId('capsule_id')->nullable()->constrained('capsules')->onDelete('cascade');
            $table->decimal('quantity', 10, 3);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->foreignId('commande_id')->nullable()->constrained('commandes')->onDelete('set null');
            $table->date('expense_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Create revenues table for tracking revenue from commandes
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
            $table->decimal('cost', 10, 2)->comment('Total production cost');
            $table->decimal('selling_price', 10, 2)->nullable()->comment('Total selling price');
            $table->decimal('margin', 10, 2)->nullable()->comment('Selling price - cost');
            $table->decimal('margin_percentage', 5, 2)->nullable()->comment('(Margin / Cost) * 100');
            $table->enum('status', ['draft', 'confirmed', 'billed', 'paid'])->default('draft')->comment('Financial status');
            $table->date('revenue_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->dropColumn(['carton_type', 'carton_price']);
        });

        Schema::table('herbs', function (Blueprint $table) {
            $table->dropColumn('purchase_price');
        });

        Schema::table('product_stock', function (Blueprint $table) {
            $table->dropColumn('purchase_price');
        });

        Schema::dropIfExists('expenses');
        Schema::dropIfExists('revenues');
    }
};

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
        // Create carton_types table
        Schema::create('carton_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // "Type A", "Type B", etc.
            $table->integer('capacity'); // Number of capsules (125000, 120000, etc.)
            $table->text('description')->nullable(); // Optional description
            $table->boolean('is_active')->default(true); // For soft-deleting types
            $table->timestamps();
        });

        // Modify capsules table to use carton_type_id
        Schema::table('capsules', function (Blueprint $table) {
            // Add foreign key column
            $table->unsignedBigInteger('carton_type_id')->nullable()->after('carton');
            
            // Add constraint
            $table->foreign('carton_type_id')
                ->references('id')
                ->on('carton_types')
                ->onDelete('restrict'); // Prevent deleting a type that's in use
            
            // Keep carton_price column (for reference/tracking)
            // If it doesn't exist from previous migration, add it
            if (!Schema::hasColumn('capsules', 'carton_price')) {
                $table->decimal('carton_price', 10, 2)->nullable()->after('carton_type_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->dropForeign(['carton_type_id']);
            $table->dropColumn('carton_type_id');
        });

        Schema::dropIfExists('carton_types');
    }
};

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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('poste')->nullable()->comment('Poste / fonction');
            $table->string('type_contrat')->nullable()->comment('CDI, CDD, journalier, etc.');
            $table->decimal('salaire', 12, 2)->nullable();
            $table->enum('salaire_type', ['mensuel', 'journalier', 'horaire'])->default('mensuel');
            $table->date('date_embauche')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('adresse')->nullable();
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};

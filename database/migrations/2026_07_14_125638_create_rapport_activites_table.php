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
        Schema::create('rapport_activites', function (Blueprint $table) {

            $table->id();

            // Rapport de travaux
            $table->foreignId('rapport_travaux_id')
                  ->constrained('rapport_travaux')
                  ->cascadeOnDelete();

            // Ligne de prix concernée
            $table->foreignId('prix_id')
                  ->constrained('prix')
                  ->cascadeOnDelete();

            $table->string('activite');
            $table->double('avancement');

            $table->timestamps();

            // Empêche d'avoir deux fois le même prix
            // dans le même rapport
            $table->unique(['rapport_travaux_id', 'prix_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_activites');
    }
};
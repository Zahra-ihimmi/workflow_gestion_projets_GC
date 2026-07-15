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
        Schema::create('assurances', function (Blueprint $table) {

            $table->id();

            // Fournisseur propriétaire de cette assurance
            $table->foreignId('fournisseur_id')
                  ->constrained('fournisseurs')
                  ->cascadeOnDelete();

            $table->string('type');              // RC, Décennale, Tous risques...
            $table->string('police')->unique();  // Numéro de police
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('quittance')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assurances');
    }
};
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
        Schema::create('vehicules', function (Blueprint $table) {

            $table->id();

            // Fournisseur propriétaire du véhicule
            $table->foreignId('fournisseur_id')
                  ->constrained('fournisseurs')
                  ->cascadeOnDelete();

            $table->string('type');
            $table->string('type_habilitation');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
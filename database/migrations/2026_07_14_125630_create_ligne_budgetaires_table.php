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
        Schema::create('ligne_budgetaires', function (Blueprint $table) {

            $table->id();

            $table->foreignId('utilisateur_id')
                  ->constrained('utilisateurs')
                  ->cascadeOnDelete();

            $table->string('intitule');
            $table->integer('annee');
            $table->string('type');
            $table->string('client');
            $table->date('date_objective');
            $table->decimal('montant_estimatif',15,2);
            $table->string('statut');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_budgetaires');
    }
};
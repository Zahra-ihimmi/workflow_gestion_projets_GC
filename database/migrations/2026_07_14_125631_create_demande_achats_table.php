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
        Schema::create('demande_achats', function (Blueprint $table) {

            $table->id();

            $table->foreignId('ligne_budgetaire_id')
                  ->constrained('ligne_budgetaires')
                  ->cascadeOnDelete();

            $table->decimal('estimation',15,2);

            $table->string('acheteur');
            $table->string('acheteur_hc');
            $table->string('lead_achat');

            $table->date('date_saisie');

            $table->string('type_projet');
            $table->string('categorie');
            $table->string('statut');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_achats');
    }
};
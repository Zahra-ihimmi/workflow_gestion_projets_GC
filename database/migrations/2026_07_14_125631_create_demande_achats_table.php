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

            $table->string('code')->unique();

            $table->foreignId('ligne_budgetaire_id')
                  ->constrained('ligne_budgetaires')
                  ->cascadeOnDelete();

            $table->foreignId('utilisateur_id')
                  ->constrained('utilisateurs')
                  ->cascadeOnDelete();

            $table->decimal('estimation', 15, 2);

            $table->date('date_saisi');

            $table->string('acheteur');

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
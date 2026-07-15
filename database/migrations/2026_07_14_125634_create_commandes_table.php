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
        Schema::create('commandes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('fournisseur_id')
                  ->constrained('fournisseurs')
                  ->cascadeOnDelete();

            // Une DA -> une seule commande
            $table->foreignId('demande_achat_id')
                  ->unique()
                  ->constrained('demande_achats')
                  ->cascadeOnDelete();

            $table->date('date_os');
            $table->integer('duree_travaux');
            $table->string('classe_hse');
            $table->decimal('montant_ht', 15, 2);
            $table->string('mode_facturation');
            $table->string('mode_paiement');
            $table->integer('duree_garantie');
            $table->string('complexite');
            $table->string('statut');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
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
        Schema::create('decomptes', function (Blueprint $table) {

            $table->id();

            // Commande concernée
            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->cascadeOnDelete();

            $table->date('date');
            $table->string('designation');
            $table->decimal('montant', 15, 2);
            $table->string('statut');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decomptes');
    }
};
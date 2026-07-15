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
        Schema::create('prix', function (Blueprint $table) {

            $table->id();

            // Une commande possède plusieurs prix
            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->cascadeOnDelete();

            $table->string('designation');
            $table->double('quantite');
            $table->decimal('prix_unitaire', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prix');
    }
};
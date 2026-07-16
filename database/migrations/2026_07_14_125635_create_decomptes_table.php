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

            $table->string('code')->unique();

            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->cascadeOnDelete();

            $table->date('date');

            $table->string('designation');

            $table->decimal('quantite_attachee', 15, 2);

            $table->string('num_ses')->nullable();

            $table->string('num_rec_ses')->nullable();

            $table->string('statut_validation');

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
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
        Schema::create('non_conformites', function (Blueprint $table) {

            $table->id();

            $table->string('code')->unique();

            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->cascadeOnDelete();

            $table->date('date');

            $table->string('classe');

            $table->string('type');

            $table->date('echeance')->nullable();

            $table->string('personnel_cin');

            $table->timestamps();

            $table->foreign('personnel_cin')
                  ->references('cin')
                  ->on('personnels')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_conformites');
    }
};
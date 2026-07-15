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

            $table->foreignId('rapport_travaux_id')
                  ->constrained('rapport_travaux')
                  ->cascadeOnDelete();

            $table->date('date');
            $table->string('classe');
            $table->string('type');
            $table->text('description');
            $table->string('plan_action');
            $table->date('echeance');

            // Responsable de la non-conformité
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
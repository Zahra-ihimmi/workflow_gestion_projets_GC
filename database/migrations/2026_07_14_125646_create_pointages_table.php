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
        Schema::create('pointages', function (Blueprint $table) {

            $table->id();

            // Personnel concerné
            $table->string('personnel_cin');

            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->decimal('nb_heure', 5, 2);

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
        Schema::dropIfExists('pointages');
    }
};
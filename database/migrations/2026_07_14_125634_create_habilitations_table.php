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
        Schema::create('habilitations', function (Blueprint $table) {

            $table->id();

            // Personnel concerné par l'habilitation
            $table->string('personnel_cin');

            // Informations sur l'habilitation
            $table->string('type');
            $table->date('date_obtention');
            $table->float('duree_habilitation');

            $table->timestamps();

            // Clé étrangère
            $table->foreign('personnel_cin')
                  ->references('cin')
                  ->on('personnels')
                  ->cascadeOnDelete()
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilitations');
    }
};
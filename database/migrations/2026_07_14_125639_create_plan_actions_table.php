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
        Schema::create('plan_actions', function (Blueprint $table) {

            $table->id();

            // Commande concernée
            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->cascadeOnDelete();

            // Personnel intervenant
            $table->string('personnel_cin');

            $table->date('date_spa');
            $table->string('activite');
            $table->integer('dangers');
            $table->text('mesures_preventives');

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
        Schema::dropIfExists('plan_actions');
    }
};
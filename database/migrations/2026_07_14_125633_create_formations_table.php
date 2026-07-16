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
        Schema::create('formations', function (Blueprint $table) {

            $table->id();
            $table->string('code')->unique();
            $table->string('personnel_cin');

            $table->date('date');
            $table->string('theme');
            $table->string('animateur');
            $table->float('score');

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
        Schema::dropIfExists('formations');
    }
};
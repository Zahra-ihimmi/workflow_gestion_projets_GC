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
        Schema::table('rapport_travaux', function (Blueprint $table) {
            $table->string('cin_reporteur', 20)->after('date');
            $table->string('meteo_matin')->nullable()->after('cin_reporteur');
            $table->string('meteo_soir')->nullable()->after('meteo_matin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapport_travaux', function (Blueprint $table) {
            $table->dropColumn(['cin_reporteur', 'meteo_matin', 'meteo_soir']);
        });
    }
};

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
        Schema::create('factures', function (Blueprint $table) {

            $table->id();
            $table->string('code')->unique();
            // Relation 1 Décompte <-> 1 Facture
            $table->foreignId('decompte_id')
                  ->unique()
                  ->constrained('decomptes')
                  ->cascadeOnDelete();

            $table->date('date_depot');
            $table->decimal('montant', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
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
    Schema::create('fichier_dcsp', function (Blueprint $table) {
        $table->id();
        $table->string('nom_fichier');
        $table->string('chemin');
        $table->string('statut')->default('En attente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichier_dcsp');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('fichiers_dcoa', function (Blueprint $table) {
        $table->id();
        $table->string('nom_fichier');
        $table->string('chemin');
        $table->string('statut')->default('envoye');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('fichiers_dcoa');
    }
};

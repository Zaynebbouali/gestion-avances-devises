<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('fichier_bancaires', function(Blueprint $table){

            $table->id();


            $table->date('date');


            $table->string('nom');


            $table->foreignId('banque_id')
                  ->constrained('banques')
                  ->cascadeOnDelete();


            $table->timestamps();

        });

    }


    public function down(): void
    {
        Schema::dropIfExists('fichier_bancaires');
    }
};
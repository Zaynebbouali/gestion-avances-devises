<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('taux_dechanges', function(Blueprint $table){

            $table->id();


            $table->string('devise');


            $table->decimal('taux',10,3);


            $table->date('date');


            $table->foreignId('user_id')->constrained('users') ->cascadeOnDelete();
            $table->enum('statut', ['envoye','lu'])->default('envoye');
            $table->timestamps();

        });

    }


    public function down(): void
    {
        Schema::dropIfExists('taux_dechanges');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('personnel_navigants', function (Blueprint $table) {

            $table->id();

            $table->string('matricule')->unique();

            $table->string('nom');

            $table->string('prenom');

            $table->string('base');


            $table->foreignId('banque_id')
                  ->constrained('banques')
                  ->cascadeOnDelete();


            $table->enum('type',[
                'PNT',
                'PNC'
            ]);
            $table->decimal('devise_totale', 10, 2)->default(0);
            $table->timestamps();

        });

    }


    public function down(): void
    {
        Schema::dropIfExists('personnel_navigants');
    }
};
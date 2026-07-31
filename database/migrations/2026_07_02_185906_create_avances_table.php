<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('avances', function(Blueprint $table){

            $table->id();


            $table->decimal('montAV',10,3);


            $table->string('base');


            $table->date('date');


            $table->enum('statut',[
                'en_attente',
                'validee',
                'payee'
            ]);


            $table->foreignId('personnel_navigant_id')
                  ->constrained('personnel_navigants')
                  ->cascadeOnDelete();



            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();



            $table->foreignId('fichier_bancaire_id')
                  ->nullable()
                  ->constrained('fichier_bancaires')
                  ->nullOnDelete();

            $table->decimal('montant_euro',10,2)->default(0);
            $table->decimal('deficit',10,2)->default(0);
            $table->decimal('reste',10,2)->default(0);

            $table->timestamps();

        });

    }


    public function down(): void
    {
        Schema::dropIfExists('avances');
    }
};
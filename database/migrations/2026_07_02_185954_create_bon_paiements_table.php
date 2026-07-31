<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('bon_paiements', function(Blueprint $table){

            $table->id();
            $table->date('date');
            $table->decimal('montant',10,3);
            $table->timestamps();

        });
Schema::table('avances', function (Blueprint $table) {
    $table->foreignId('bon_paiement_id')
          ->nullable()
          ->constrained('bon_paiements')
          ->nullOnDelete();
});
    }



    public function down(): void
{
    Schema::table('avances', function (Blueprint $table) {
        $table->dropForeign(['bon_paiement_id']);
        $table->dropColumn('bon_paiement_id');
    });

    Schema::dropIfExists('bon_paiements');
}
};
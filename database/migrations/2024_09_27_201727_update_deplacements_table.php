<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deplacements', function (Blueprint $table) {

            $table->unsignedBigInteger('chauffeur_id'); // Clé étrangère vers Chauffeur
            $table->foreign('chauffeur_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('demande_dechet_id')->nullable(); // Clé étrangère vers demandes_dechets
            $table->foreign('demande_dechet_id')->references('id')->on('demandes_dechets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deplacements', function (Blueprint $table) {
            $table->dropForeign(['chauffeur_id']);
            $table->dropColumn('chauffeur_id');

            $table->dropForeign(['demande_dechet_id']);
            $table->dropColumn('demande_dechet_id');
        });
    }
};

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
        Schema::table('demande_matiere_premieres', function (Blueprint $table) {

            $table->unsignedBigInteger('societe_id'); // Clé étrangère vers Societe
            $table->foreign('societe_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('matiere_premiere_id'); // Clé étrangère vers MatierePremiere
            $table->foreign('matiere_premiere_id')->references('id')->on('matiere_premieres')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demande_matiere_premieres', function (Blueprint $table) {
            $table->dropForeign(['societe_id']);
            $table->dropColumn('societe_id');

            $table->dropForeign(['matiere_premiere_id']);
            $table->dropColumn('matiere_premiere_id');
        });
    }
};

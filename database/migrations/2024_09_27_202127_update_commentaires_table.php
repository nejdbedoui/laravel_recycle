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
        Schema::table('commentaires', function (Blueprint $table) {

            // Clé étrangère vers EvenementCommunautaire
            $table->unsignedBigInteger('evenement_communautaire_id');
            $table->foreign('evenement_communautaire_id')
                ->references('id')
                ->on('evenements_communautaires')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentaires', function (Blueprint $table) {
            $table->dropForeign(['evenement_communautaire_id']);
            $table->dropColumn('evenement_communautaire_id');
        });
    }
};

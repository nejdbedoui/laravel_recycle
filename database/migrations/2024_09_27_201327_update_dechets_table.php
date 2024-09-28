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
        Schema::table('dechets', function (Blueprint $table) {

            // Clé étrangère vers CentreCollecte
            $table->unsignedBigInteger('centre_collecte_id')->nullable();
            $table->foreign('centre_collecte_id')->references('id')->on('centre_collectes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dechets', function (Blueprint $table) {
            $table->dropForeign(['centre_collecte_id']);
            $table->dropColumn('centre_collecte_id');
        });
    }
};

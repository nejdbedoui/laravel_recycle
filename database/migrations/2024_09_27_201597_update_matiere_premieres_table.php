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
        Schema::table('matiere_premieres', function (Blueprint $table) {

            $table->unsignedBigInteger('centre_recyclage_id');  // Clé étrangère vers CentreRecyclage
            $table->foreign('centre_recyclage_id')->references('id')->on('centre_recyclages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matiere_premieres', function (Blueprint $table) {
            $table->dropForeign(['centre_recyclage_id']);
            $table->dropColumn('centre_recyclage_id');
        });
    }
};

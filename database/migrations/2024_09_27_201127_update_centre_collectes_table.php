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
        Schema::table('centre_collectes', function (Blueprint $table) {

            // Clé étrangère pour la relation One-to-One avec ZoneCollecte
            $table->unsignedBigInteger('zone_collecte_id')->nullable();
            $table->foreign('zone_collecte_id')->references('id')->on('zone_collectes')->onDelete('cascade');

            // Clé étrangère vers AdminCentreCollecte
            $table->unsignedBigInteger('admin_centre_collecte_id')->nullable();
            $table->foreign('admin_centre_collecte_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centre_collectes', function (Blueprint $table) {
            $table->dropForeign(['zone_collecte_id']);
            $table->dropColumn('zone_collecte_id');

            $table->dropForeign(['admin_centre_collecte_id']);
            $table->dropColumn('admin_centre_collecte_id');
        });
    }
};

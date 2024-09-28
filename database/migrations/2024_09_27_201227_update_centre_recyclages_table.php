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
        Schema::table('centre_recyclages', function (Blueprint $table) {

            // Clé étrangère pour la relation One-to-One avec AdminCentreRecyclage
            $table->unsignedBigInteger('admin_centre_recyclage_id')->nullable();
            $table->foreign('admin_centre_recyclage_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centre_recyclages', function (Blueprint $table) {
            $table->dropForeign(['admin_centre_recyclage_id']);
            $table->dropColumn('admin_centre_recyclage_id');
        });
    }
};

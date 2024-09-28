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
        Schema::table('type_dechets', function (Blueprint $table) {

            // Clé étrangère vers Dechet
            $table->unsignedBigInteger('dechet_id')->nullable();
            $table->foreign('dechet_id')->references('id')->on('dechets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_dechets', function (Blueprint $table) {
            $table->dropForeign(['dechet_id']);
            $table->dropColumn('dechet_id');
        });
    }
};

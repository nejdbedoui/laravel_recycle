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
        Schema::create('chauffeur_zone_collecte', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chauffeur_id'); // Clé étrangère vers Chauffeur
            $table->foreign('chauffeur_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('zone_collecte_id'); // Clé étrangère vers ZoneCollecte
            $table->foreign('zone_collecte_id')->references('id')->on('zone_collectes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chauffeur_zone_collecte');
    }
};

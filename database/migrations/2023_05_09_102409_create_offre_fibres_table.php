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
        Schema::create('offre_fibres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->references('id')->on('offres');
            $table->foreignId('fibre_id')->references('id')->on('fibres');
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
        Schema::dropIfExists('offre_fibres');
    }
};

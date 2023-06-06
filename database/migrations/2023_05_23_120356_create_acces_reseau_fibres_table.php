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
        Schema::create('acces_reseau_fibres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acces_reseau_id')->references('id')->on('acces_reseaus')->onDelete('cascade');
            $table->foreignId('fibre_id')->references('id')->on('fibres')->onDelete('cascade');
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
        Schema::dropIfExists('acces_reseau_fibres');
    }
};

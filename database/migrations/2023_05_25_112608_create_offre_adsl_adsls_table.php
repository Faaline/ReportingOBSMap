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
        Schema::create('offre_adsl_adsls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_adsl_id')->references('id')->on('offre_adsls')->onDelete('cascade');
            $table->foreignId('adsl_id')->references('id')->on('adsls')->onDelete('cascade');
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
        Schema::dropIfExists('offre_adsl_adsls');
    }
};

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
        Schema::create('segment_segment_marches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segment_id')->references('id')->on('segments')->onDelete('cascade');
            $table->foreignId('segment_marche_id')->references('id')->on('segment_marches')->onDelete('cascade');
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
        Schema::dropIfExists('segment_segment_marches');
    }
};

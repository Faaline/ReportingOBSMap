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
        Schema::create('commune_reparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commune_id')->references('id')->on('communes')->onDelete('cascade');
            $table->foreignId('repart_id')->references('id')->on('reparts')->onDelete('cascade');
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
        Schema::dropIfExists('commune_reparts');
    }
};

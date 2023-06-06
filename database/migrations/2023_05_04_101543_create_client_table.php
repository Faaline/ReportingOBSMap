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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('ncli');
            $table->integer('ndos');
            $table->string('produit');
            $table->string('nd');
            $table->string('bouquet_tv');
            $table->string('service_fal');
            $table->foreignId('statut_id')->references('id')->on('statuts')->onDelete('cascade');
            $table->string('nd_smm');
            $table->string('login_smm');
            $table->string('code_por');
            $table->dateTime('date_msv');
            $table->dateTime('datms_ac');
            $table->string('prenom');
            $table->string('nom');
            $table->foreignId('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('contact_mob');
            $table->string('contact_email');
            $table->foreignId('segment_id')->references('id')->on('segments')->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
};

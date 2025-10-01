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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('name_Info')->nullable();
            $table->string('content_Info')->nullable();
            $table->string('tel_Info')->nullable();
            $table->string('adresse1_Info')->nullable();
            $table->string('adresse12_Info')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->foreignId('ville_id')->constrained('villes')->onDelete('cascade');

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
        Schema::dropIfExists('infos');
    }
};

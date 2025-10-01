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
        Schema::create('programes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('commune_id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('is_garde')->default(false);
            $table->timestamps();

            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
        });

        // table pivot programme_pharmacie
        Schema::create('programe_pharmacie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programe_id');
            $table->unsignedBigInteger('pharmacie_id');

            $table->foreign('programe_id')->references('id')->on('programes')->onDelete('cascade');
            $table->foreign('pharmacie_id')->references('id')->on('pharmacies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programes');
    }
};

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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('programe_id')
                ->constrained('programes')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('ville_id')
                ->constrained('villes')
                ->onDelete('cascade');

            $table->unsignedTinyInteger('month'); // Mois du téléchargement
            $table->unsignedSmallInteger('year'); // Année du téléchargement

            $table->unsignedBigInteger('total_downloads')->default(0); // Nombre total de téléchargements pour cette période

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['programe_id', 'ville_id', 'user_id', 'month', 'year'], 'unique_download_per_month');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downloads');
    }
};

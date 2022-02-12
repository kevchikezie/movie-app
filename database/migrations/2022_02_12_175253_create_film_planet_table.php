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
        Schema::create('film_planet', function (Blueprint $table) {
            $table->id();
            $table->integer('planet_id');
            $table->integer('film_id');
            $table->timestamps();

            $table->foreign('planet_id')
                  ->references('id')
                  ->on('planets')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('film_id')
                  ->references('id')
                  ->on('films')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_planet');
    }
};

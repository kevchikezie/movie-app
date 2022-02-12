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
        Schema::create('film_people', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('people_id')->unsigned();
            $table->bigInteger('film_id')->unsigned();
            $table->timestamps();

            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('film_id')->references('id')->on('films');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_people');
    }
};

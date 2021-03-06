<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Calendarevents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('calendarevents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('start');
            $table->string('end');
            $table->string('color');
            $table->string('draggable');
            $table->string('resizable');
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
        //
        Schema::dropIfExists('calendarevents');
    }
}

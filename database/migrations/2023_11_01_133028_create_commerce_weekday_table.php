<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commerce_weekday', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('commerce_id')->unsigned();
            $table->foreign('commerce_id')->references('id')->on('commerces');

            $table->bigInteger('weekday_id')->unsigned();
            $table->foreign('weekday_id')->references('id')->on('weekdays');

            $table->integer('hour_open')->unsigned()->nullable();
            $table->integer('minute_open')->unsigned()->nullable();

            $table->integer('hour_close')->unsigned()->nullable();
            $table->integer('minute_close')->unsigned()->nullable();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('commerce_weekday');
    }
};

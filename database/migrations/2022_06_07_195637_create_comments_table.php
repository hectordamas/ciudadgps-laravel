<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('comment')->nullable();
            $table->float('rating', 100, 2)->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('commerce_id')->unsigned()->nullable();
            $table->foreign('commerce_id')->references('id')->on('commerces');        
        });
    }


    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

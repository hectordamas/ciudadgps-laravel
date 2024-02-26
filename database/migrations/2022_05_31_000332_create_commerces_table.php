<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercesTable extends Migration
{
    public function up()
    {
        Schema::create('commerces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('name')->nullable();
            $table->longText('user_name')->nullable();
            $table->longText('user_lastname')->nullable();
            $table->string('user_email')->nullable();

            $table->longText('telephone_code')->nullable();
            $table->longText('telephone_number')->nullable();
            $table->longText('telephone_number_code')->nullable();
            $table->longText('telephone')->nullable();
            
            $table->longText('info')->nullable();
            $table->string('logo')->nullable();
            $table->longText('address')->nullable();
            $table->float('lat', 100, 10)->nullable();
            $table->float('lon', 100, 10)->nullable();
            
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('web')->nullable();

            $table->string('payment')->nullable();
            $table->string('paid')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->float('rating', 100, 2)->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('commerces');
    }
}

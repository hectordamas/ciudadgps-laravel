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
        Schema::create('story_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('story_image')->nullable();
            $table->longText('swipeText')->nullable();
            $table->bigInteger('position')->unsigned()->nullable();
            $table->bigInteger('story_id')->unsigned()->nullable();
            $table->foreign('story_id')->references('id')->on('stories');        
            $table->longText('linkText')->nullable();
            $table->longText('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::dropIfExists('story_items');

        $stories = \App\Models\Story::all();
        foreach($stories as $s){
            $s->delete();
        }

        Schema::table('stories', function (Blueprint $table) {

            $table->dropColumn(['user_id', 'position', 'user_image', 'user_name']);

            $table->bigInteger('commerce_id')->unsigned();
            $table->foreign('commerce_id')->references('id')->on('commerces');

            $table->longText('image')->nullable();
            $table->longText('text')->nullable();
        });
    }


    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeign(['commerce_id']);
            $table->dropColumn(['image', 'text']);
        });
    }
};

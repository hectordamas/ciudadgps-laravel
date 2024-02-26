<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('banner')->nullable();
            $table->longText('url')->nullable();
            $table->bigInteger('commerce_id')->unsigned()->nullable();
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->string('section')->nullable();
            $table->string('hide')->nullable();
            $table->bigInteger('position')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['banner', 'url', 'section', 'hide', 'position']);
            $table->dropForeign(['commerce_id']);
        });
    }
}

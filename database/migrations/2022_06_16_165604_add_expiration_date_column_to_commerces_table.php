<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpirationDateColumnToCommercesTable extends Migration
{

    public function up()
    {
        Schema::table('commerces', function (Blueprint $table) {
            $table->string('expiration_date')->nullable();
        });
    }


    public function down()
    {
        Schema::table('commerces', function (Blueprint $table) {
            $table->dropColumn('expiration_date');
        });
    }
}

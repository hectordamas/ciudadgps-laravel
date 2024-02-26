<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappCodeColumnToCommercesTable extends Migration
{

    public function up()
    {
        Schema::table('commerces', function (Blueprint $table) {
            $table->string('whatsapp_code')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('whatsapp_number_code')->nullable();
        });
    }


    public function down()
    {
        Schema::table('commerces', function (Blueprint $table) {
            $table->dropColumn('whatsapp_code');
            $table->dropColumn('whatsapp_number');
            $table->dropColumn('whatsapp_number_code');
        });
    }
}

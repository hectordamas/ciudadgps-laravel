<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('weekdays', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->integer('day')->nullable();
        });

        DB::table('weekdays')->insert([
            ['day' => 0, 'name' => 'Domingo'],
            ['day' => 1, 'name' => 'Lunes'],
            ['day' => 2, 'name' => 'Martes'],
            ['day' => 3, 'name' => 'Miércoles'],
            ['day' => 4, 'name' => 'Jueves'],
            ['day' => 5, 'name' => 'Viernes'],
            ['day' => 6, 'name' => 'Sábado'],
        ]);
    }


    public function down()
    {
        Schema::dropIfExists('weekdays');
    }
};

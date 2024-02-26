<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new User();
        $user->name = "Héctor Damas";
        $user->email = "hectorgabrieldm@hotmail.com";
        $user->role = "Administrador";
        $user->password = Hash::make("alinware98_");
        $user->save();

        $user = new User();
        $user->name = "Jesús Bigorra";
        $user->email = "jesus201@gmail.com";
        $user->role = "Administrador";
        $user->password = Hash::make("Ciudadgps2022*");
        $user->save();

        $user = new User();
        $user->name = "Gabriel Crescenzi";
        $user->email = "ggabboc@gmail.com";
        $user->role = "Administrador";
        $user->password = Hash::make("Ciudadgps2022*");
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Category;
use \App\Models\Commerce;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_commerces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('commerce_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('commerce_id')->references('id')->on('commerces')->onDelete('cascade');
        });

        $categories = Category::all();
        foreach ($categories as $category) {
            $commerces = Commerce::where('category_id', $category->id);
            $category->commerces()->sync($commerces->pluck('id'));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_commerces');
    }
};

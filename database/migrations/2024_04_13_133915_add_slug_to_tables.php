<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('commerces', function (Blueprint $table) {
            $table->string('slug');
        });
        $comercios = DB::table('commerces')->get();
        foreach ($comercios as $comercio) {
            $slug = Str::slug($comercio->name);
            DB::table('commerces')->where('id', $comercio->id)->update(['slug' => $slug]);
        }

        Schema::table('jobs', function (Blueprint $table) {
            $table->string('slug');
        });
        $jobs = DB::table('jobs')->get();
        foreach ($jobs as $job) {
            $slug = Str::slug($job->title) . '-' . $job->id; // Use the appropriate property for the slug
            DB::table('jobs')->where('id', $job->id)->update(['slug' => $slug]);
        }

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug');
        });
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            $slug = Str::slug($product->name) . '-' . $job->id; // Use the appropriate property for the slug
            DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug');
        });
        $categories = DB::table('categories')->get();
        foreach ($categories as $category) {
            $slug = Str::slug($category->name); // Use the appropriate property for the slug
            DB::table('categories')->where('id', $category->id)->update(['slug' => $slug]);
        }
        $articles = DB::table('articles')->get();
        foreach ($articles as $article) {
            $slug = Str::slug($article->title); // Use the appropriate property for the slug
            DB::table('articles')->where('id', $article->id)->update(['slug' => $slug]);
        }
        
    }

    public function down()
    {
        Schema::table('commerces', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};

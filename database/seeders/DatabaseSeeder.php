<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommerceSeeder;
use Database\Seeders\ImagesSeeder;
use Database\Seeders\CommentsSeeder;
use Database\Seeders\BannersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            CommerceSeeder::class,
            ImagesSeeder::class,
            CommentsSeeder::class,
            BannersSeeder::class,
        ]);
    }
}

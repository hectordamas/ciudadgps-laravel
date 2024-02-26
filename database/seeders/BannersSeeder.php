<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Banner::factory(50)->create();
    }
}

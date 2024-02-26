<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    public function run()
    {
        \App\Models\Story::factory(50)->create();
    }
}
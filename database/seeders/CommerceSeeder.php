<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommerceSeeder extends Seeder
{

    public function run()
    {
        \App\Models\Commerce::factory(100)->create();
    }
}

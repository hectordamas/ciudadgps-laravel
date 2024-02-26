<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph(3),
            'whatsapp' => '584241930033',
            'whatsapp_code' => 'VE',
            'whatsapp_number_code' => '+58',
            'whatsapp_number' => '4241930033',
            'email' => 'hectorgabrieldm@hotmail.com',
            'commerce_id' =>  $this->faker->numberBetween(107, 140),
        ];
    }
}

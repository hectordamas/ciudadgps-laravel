<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'price' => $this->faker->numberBetween($min = 12, $max = 6000),
            'commerce_id' =>  $this->faker->numberBetween(107, 140),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uri' => '/images/image' . $this->faker->numberBetween(1, 10) . '.jpg',
            'commerce_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}

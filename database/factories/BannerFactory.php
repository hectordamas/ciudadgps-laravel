<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $section = ['Sección 1', "Sección 2", "Sección 3", "Sección 4"];

        return [
            'banner' => '/bannersDirectory/banner' . $this->faker->numberBetween(1, 4) . '.jpg',
            'url' => '',
            'commerce_id' =>  $this->faker->numberBetween(1, 100),
            'section' => $section[$this->faker->numberBetween(0, 3)],
            'hide' =>  "No",
            'position' => $this->faker->numberBetween(1, 100),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'commerce_id' =>  $this->faker->numberBetween(101, 140),
            'image' => '/storiesImages/1676475509d1f262e9-faa4-4844-a6cb-e20dc4c7b465.jpeg',
            'text' => 'Dios no crea nada en vano'
        ];
    }
}

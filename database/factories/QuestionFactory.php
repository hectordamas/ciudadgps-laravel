<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition()
    {
        return [
            'message' => $this->faker->paragraph(3),
            'user_id' => 1,
            'commerce_id' => 101,
        ];
    }
}

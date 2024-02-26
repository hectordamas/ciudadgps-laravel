<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    public function definition(){
        return [
            'message' => $this->faker->paragraph(3),
            'user_id' => 2,
            'commerce_id' => 101,
            'question_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}

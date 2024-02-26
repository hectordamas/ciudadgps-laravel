<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rating = $this->faker->numberBetween(1, 5);
        $commerce_id = $this->faker->numberBetween(1, 100);
        $user_id = 1;

        $comment = new \App\Models\Comment();
        $comment->comment = $this->faker->paragraph(3);
        $comment->rating = $rating;
        $comment->commerce_id = $commerce_id;
        $comment->user_id = $user_id;
        $comment->save();

        $commerce = \App\Models\Commerce::find($commerce_id);
        $totalRating = 0;

        foreach($commerce->comments as $c){
            $totalRating = $totalRating + $c->rating;
        }

        if($commerce->comments->count() > 0){
            $totalRating = $totalRating / $commerce->comments->count();
            $commerce->rating = $totalRating;
        }
        $commerce->save();

        return [];
    }
}

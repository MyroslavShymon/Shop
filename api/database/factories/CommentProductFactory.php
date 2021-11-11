<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 30),
            'product_id' => $this->faker->numberBetween(1, 50),
            'text' => $this->faker->text(),
        ];
    }
}

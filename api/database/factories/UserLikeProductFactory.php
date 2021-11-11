<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserLikeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 50),
            'user_id' => $this->faker->numberBetween(1, 30),
            'text' => $this->faker->text(),
        ];
    }
}

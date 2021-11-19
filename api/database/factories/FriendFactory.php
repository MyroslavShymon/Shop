<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id_1' => $this->faker->numberBetween(1, 30),
            'user_id_2' => $this->faker->numberBetween(1, 30),
        ];
    }
}

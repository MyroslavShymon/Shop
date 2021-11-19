<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_user_id' => $this->faker->numberBetween(1, 30),
            'to_user_id' => $this->faker->numberBetween(1, 30),
            'text' => $this->faker->text(),
        ];
    }
}

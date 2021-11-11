<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BasketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1,30)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word(),
            'description' => $this->faker->text(),
            'views' => $this->faker->numberBetween(1, 30),
            'image' => '/api/image/' . $this->faker->randomNumber(1, 20),
            'user_id' => $this->faker->numberBetween(1, 30),
            'product_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}

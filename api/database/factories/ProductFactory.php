<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(1, 1, 1000),
            'image' => '/api/image/' . $this->faker->randomNumber(1, 20),
            'brand_id' => $this->faker->randomNumber(1, 30),
            'type_id' => $this->faker->randomNumber(1, 30),
            'user_id' => $this->faker->randomNumber(1, 30),
            'views' => 0,
        ];
    }
}

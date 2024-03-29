<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word(),
            'description'=> $this->faker->text(),
            'image'=> '/api/image/' . $this->faker->randomNumber(1,20),
        ];
    }
}

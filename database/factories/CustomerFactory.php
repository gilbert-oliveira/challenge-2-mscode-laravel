<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'document' => rand(0,1) ? rand(10000000000,99999999999) : rand(10000000000000, 99999999999999),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}

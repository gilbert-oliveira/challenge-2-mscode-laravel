<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tigo\DocumentBr\Cnpj;
use Tigo\DocumentBr\Cpf;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cpf = new Cpf();
        $cnpf = new Cnpj();
        return [
            'name' => $this->faker->unique()->name(),
            'document' => rand(0,1) ? $cpf->generate() : $cnpf->generate(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}

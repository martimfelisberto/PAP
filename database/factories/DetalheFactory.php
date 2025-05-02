<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detalhe>
 */
class DetalheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'nome' => $this ->faker->name,
            'quantidade' => $this ->faker->number,
            'description' => $this ->faker->sentence,
            'data_fabricacao' => $this ->faker->date,
            'data_validade' => $this ->faker->date,
            
        ];
    }
}


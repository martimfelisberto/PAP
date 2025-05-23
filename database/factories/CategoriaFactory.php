<?php
 
namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;
 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'description' => $this->faker->word,
            'preco' => $this->faker->word,
            'marca' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
       
          
        ];
    }
}

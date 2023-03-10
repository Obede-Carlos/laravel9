<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "titulo" => $this->faker->word(),
            "genero" => $this->faker->randomElement(['narrativo', 'lirico', 'dramatico', 'didactico',]),
            "autor" => $this->faker->name(),
            "ejemplares" => $this->faker->numberBetween(0, 1000),
            "precio" => $this->faker->randomFloat(2, 9, 99),
            "publisher_id" => Publisher::inRandomOrder()->first()->id
        ];
    }
}

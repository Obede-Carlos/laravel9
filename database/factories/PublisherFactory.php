<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->company(),
            "director" => $this->faker->name(),
            "plantas" => $this->faker->numberBetween(1, 10),
            "empleados" => $this->faker->numberBetween(10, 100000),
        ];
    }
}

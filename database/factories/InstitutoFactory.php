<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instituto>
 */
class InstitutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "cod_instituto" => $this->faker->regexify('[A-Z]{4}[0-9]{6}'),
            "nombre" => $this->faker->word(120),
            "localidad" => $this->faker->word(50),
            "numalumnos"=> $this->faker->numberBetween(60, 990),
        ];
    }
}

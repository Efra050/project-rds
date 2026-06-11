<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cargo_id' => \App\Models\Cargo::inRandomOrder()->first()->id ?? 1,
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'fecha_ingreso' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'salario' => $this->faker->numberBetween(1000000, 8000000),
            'estado' => true,
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;

    public function test_rendimientos_de_indice_de_empleados(): void
    {
        $cargo = Cargo::create(['nombre_cargo' => 'Dev', 'descripcion' => 'Desc']);

        Empleado::create([
            'cargo_id' => $cargo->id,
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'fecha_nacimiento' => '1990-01-01',
            'fecha_ingreso' => '2020-01-01',
            'salario' => 1000.50,
            'estado' => true,
        ]);

        $this->getJson('/api/empleados')
            ->assertStatus(200)
            ->assertJsonStructure(['*' => ['id', 'cargo_id', 'nombre', 'apellido', 'fecha_nacimiento', 'fecha_ingreso', 'salario', 'estado', 'cargo']]);
    }

    public function test_campos_y_crea_recursos(): void
    {
        $this->postJson('/api/empleados', [])->assertStatus(422)
            ->assertJsonValidationErrors(['cargo_id', 'nombre', 'apellido', 'fecha_nacimiento', 'fecha_ingreso', 'salario', 'estado']);

        $cargo = Cargo::create(['nombre_cargo' => 'HR', 'descripcion' => 'Desc']);

        $payload = [
            'cargo_id' => $cargo->id,
            'nombre' => 'Ana',
            'apellido' => 'Gomez',
            'fecha_nacimiento' => '1992-05-05',
            'fecha_ingreso' => '2021-06-01',
            'salario' => 1500.75,
            'estado' => true,
        ];

        $this->postJson('/api/empleados', $payload)
            ->assertStatus(201)
            ->assertJsonFragment(['nombre' => 'Ana', 'apellido' => 'Gomez']);

        $this->assertDatabaseHas('empleados', ['nombre' => 'Ana', 'apellido' => 'Gomez']);
    }

    public function test_Comportamiento_de_actualizacion_y_eliminacion(): void
    {
        $cargo = Cargo::create(['nombre_cargo' => 'C', 'descripcion' => 'D']);

        $empleado = Empleado::create([
            'cargo_id' => $cargo->id,
            'nombre' => 'Luis',
            'apellido' => 'Lopez',
            'fecha_nacimiento' => '1985-02-02',
            'fecha_ingreso' => '2010-03-03',
            'salario' => 2000,
            'estado' => true,
        ]);

        $this->getJson("/api/empleados/{$empleado->id}")
            ->assertStatus(200)
            ->assertJsonFragment(['nombre' => 'Luis']);

        // Actualización no válida (cadena de salario)
        $this->putJson("/api/empleados/{$empleado->id}", ['salario' => 'no-num'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['salario']);

        // actualización válida
        $this->putJson("/api/empleados/{$empleado->id}", ['nombre' => 'Luisito', 'salario' => 2500.5])
            ->assertStatus(200)
            ->assertJsonFragment(['nombre' => 'Luisito', 'salario' => 2500.5]);

        $this->assertDatabaseHas('empleados', ['id' => $empleado->id, 'nombre' => 'Luisito']);

        $this->deleteJson("/api/empleados/{$empleado->id}")->assertStatus(204);

        $this->assertDatabaseMissing('empleados', ['id' => $empleado->id]);
    }
}

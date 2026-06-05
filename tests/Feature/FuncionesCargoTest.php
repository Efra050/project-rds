<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\FuncionesCargo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FuncionesCargoTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_funciones_with_cargo(): void
    {
        $cargo = Cargo::create(['nombre_cargo' => 'Prueba', 'descripcion' => 'Desc']);

        $funcion = FuncionesCargo::create([
            'cargo_id' => $cargo->id,
            'descripcion_funcion' => 'Hacer pruebas',
            'estado' => true,
        ]);

        $response = $this->getJson('/api/funciones-cargos');

        $response->assertStatus(200)
            ->assertJsonStructure(['*' => ['id', 'cargo_id', 'descripcion_funcion', 'estado', 'cargo']])
            ->assertJsonFragment(['descripcion_funcion' => 'Hacer pruebas']);
    }

    public function test_store_requires_fields_and_creates_resource(): void
    {
        // validation errors when payload empty
        $this->postJson('/api/funciones-cargos', [])->assertStatus(422)
            ->assertJsonValidationErrors(['cargo_id', 'descripcion_funcion', 'estado']);

        // create with valid payload
        $cargo = Cargo::create(['nombre_cargo' => 'Otro', 'descripcion' => 'Desc']);

        $payload = [
            'cargo_id' => $cargo->id,
            'descripcion_funcion' => 'Nueva función',
            'estado' => true,
        ];

        $resp = $this->postJson('/api/funciones-cargos', $payload);

        $resp->assertStatus(201)
            ->assertJsonFragment(['descripcion_funcion' => 'Nueva función', 'cargo_id' => $cargo->id]);

        $this->assertDatabaseHas('funciones_cargos', ['descripcion_funcion' => 'Nueva función']);
    }

    public function test_show_update_and_delete_behaviour(): void
    {
        $cargo = Cargo::create(['nombre_cargo' => 'C', 'descripcion' => 'D']);

        $funcion = FuncionesCargo::create([
            'cargo_id' => $cargo->id,
            'descripcion_funcion' => 'Inicial',
            'estado' => true,
        ]);

        // show
        $this->getJson("/api/funciones-cargos/{$funcion->id}")
            ->assertStatus(200)
            ->assertJsonFragment(['descripcion_funcion' => 'Inicial']);

        // invalid update (wrong estado type)
        $this->putJson("/api/funciones-cargos/{$funcion->id}", ['estado' => 'notbool'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['estado']);

        // valid update
        $this->putJson("/api/funciones-cargos/{$funcion->id}", ['descripcion_funcion' => 'Modificada', 'estado' => false])
            ->assertStatus(200)
            ->assertJsonFragment(['descripcion_funcion' => 'Modificada', 'estado' => false]);

        $this->assertDatabaseHas('funciones_cargos', ['id' => $funcion->id, 'descripcion_funcion' => 'Modificada']);

        // delete
        $this->deleteJson("/api/funciones-cargos/{$funcion->id}")->assertStatus(204);

        $this->assertDatabaseMissing('funciones_cargos', ['id' => $funcion->id]);
    }
}

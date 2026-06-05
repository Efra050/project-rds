<?php

namespace Tests\Feature;

use App\Models\Cargo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CargoTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_cargos_with_relations(): void
    {
        $cargo = Cargo::create(['nombre_cargo' => 'Dev', 'descripcion' => 'Desarrollador']);

        $response = $this->getJson('/api/cargos');

        $response->assertStatus(200)
            ->assertJsonStructure(['*' => ['id', 'nombre_cargo', 'descripcion', 'empleados', 'funcionescargos']])
            ->assertJsonFragment(['nombre_cargo' => 'Dev']);
    }

    public function test_store_requires_fields_and_creates_resource(): void
    {
        $this->postJson('/api/cargos', [])->assertStatus(422)
            ->assertJsonValidationErrors(['nombre_cargo', 'descripcion']);

        $payload = ['nombre_cargo' => 'QA', 'descripcion' => 'QA desc'];

        $resp = $this->postJson('/api/cargos', $payload);

        $resp->assertStatus(201)
            ->assertJsonFragment(['nombre_cargo' => 'QA']);

        $this->assertDatabaseHas('cargos', ['nombre_cargo' => 'QA']);
    }

    public function test_show_update_and_delete_behaviour(): void
    {
        $cargo = Cargo::create(['nombre_cargo' => 'Ops', 'descripcion' => 'Ops desc']);

        $this->getJson("/api/cargos/{$cargo->id}")
            ->assertStatus(200)
            ->assertJsonFragment(['nombre_cargo' => 'Ops']);

        // actualización no válida
        $this->putJson("/api/cargos/{$cargo->id}", ['nombre_cargo' => ''])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['nombre_cargo']);

        // actualización válida
        $this->putJson("/api/cargos/{$cargo->id}", ['nombre_cargo' => 'Ops2', 'descripcion' => 'Updated'])
            ->assertStatus(200)
            ->assertJsonFragment(['nombre_cargo' => 'Ops2']);

        $this->assertDatabaseHas('cargos', ['id' => $cargo->id, 'nombre_cargo' => 'Ops2']);

        $this->deleteJson("/api/cargos/{$cargo->id}")->assertStatus(204);

        $this->assertDatabaseMissing('cargos', ['id' => $cargo->id]);
    }
}

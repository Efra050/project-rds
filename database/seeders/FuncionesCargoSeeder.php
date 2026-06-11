<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionesCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 funciones por cada cargo (40 cargos * 5 = 200 funciones)
        \App\Models\Cargo::all()->each(function ($cargo) {
            \App\Models\FuncionesCargo::factory(5)->create([
                'cargo_id' => $cargo->id,
            ]);
        });
    }
}

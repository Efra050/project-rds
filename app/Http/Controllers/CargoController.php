<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        return Cargo::with(['empleados', 'funcionescargos'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_cargo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
        ]);

        $cargo = Cargo::create($data);

        return response()->json($cargo, 201);
    }

    public function show(Cargo $cargo)
    {
        return $cargo->load(['empleados', 'funcionescargos']);
    }

    public function update(Request $request, Cargo $cargo)
    {
        $data = $request->validate([
            'nombre_cargo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string|max:1000',
        ]);

        $cargo->update($data);

        return response()->json($cargo);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page');

        $cargo = Cargo::paginateWithRelations((int) $perPage, $page ? (int) $page : null);

        if ($cargo->isEmpty()) {
            return response()->json(['message' => 'No hay cargos disponibles en esta pagina'],'404');
        }

        return response()->json($cargo, 200);
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

    public function show($id)
    {
        $cargo = Cargo::with(['empleados', 'funcionescargos'])->findOrFail($id);

        return response()->json($cargo->toArray());
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre_cargo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string|max:1000',
        ]);

        $cargo = Cargo::findOrFail($id);

        $cargo->update($data);

        $fresh = Cargo::with(['empleados', 'funcionescargos'])->findOrFail($cargo->id);

        return response()->json($fresh->toArray());
    }

    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);

        $cargo->delete();

        return response()->json(null, 204);
    }
}

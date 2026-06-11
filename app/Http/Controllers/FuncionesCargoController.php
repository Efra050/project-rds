<?php

namespace App\Http\Controllers;

use App\Models\FuncionesCargo;
use Illuminate\Http\Request;

class FuncionesCargoController extends Controller
{
    public function index()
    {
        return FuncionesCargo::with('cargo')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cargo_id' => 'required|exists:cargos,id',
            'descripcion_funcion' => 'required|string|max:1000',
            'estado' => 'required|boolean',
        ]);

        $funcion = FuncionesCargo::create($data);

        return response()->json($funcion->load('cargo'), 201);
    }

    public function show($id)
    {
        $func = FuncionesCargo::with('cargo')->findOrFail($id);

        return response()->json($func->toArray());
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'cargo_id' => 'sometimes|required|exists:cargos,id',
            'descripcion_funcion' => 'sometimes|required|string|max:1000',
            'estado' => 'sometimes|required|boolean',
        ]);

        $funcionesCargo = FuncionesCargo::findOrFail($id);

        $funcionesCargo->update($data);

        $fresh = FuncionesCargo::with('cargo')->findOrFail($funcionesCargo->id);

        return response()->json($fresh->toArray());
    }

    public function destroy($id)
    {
        $funcionesCargo = FuncionesCargo::findOrFail($id);

        $funcionesCargo->delete();

        return response()->json(null, 204);
    }
    
}

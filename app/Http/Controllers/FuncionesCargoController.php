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

    public function show(FuncionesCargo $funcionesCargo)
    {
        return $funcionesCargo->load('cargo');
    }

    public function update(Request $request, FuncionesCargo $funcionesCargo)
    {
        $data = $request->validate([
            'cargo_id' => 'sometimes|required|exists:cargos,id',
            'descripcion_funcion' => 'sometimes|required|string|max:1000',
            'estado' => 'sometimes|required|boolean',
        ]);

        $funcionesCargo->update($data);

        return response()->json($funcionesCargo->load('cargo'));
    }

    public function destroy(FuncionesCargo $funcionesCargo)
    {
        $funcionesCargo->delete();

        return response()->json(null, 204);
    }
}

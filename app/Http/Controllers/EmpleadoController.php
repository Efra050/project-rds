<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        return Empleado::with('cargo')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cargo_id' => 'required|exists:cargos,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric',
            'estado' => 'required|boolean',
        ]);

        $empleado = Empleado::create($data);

        return response()->json($empleado->load('cargo'), 201);
    }

    public function show(Empleado $empleado)
    {
        return $empleado->load('cargo');
    }

    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->validate([
            'cargo_id' => 'sometimes|required|exists:cargos,id',
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'fecha_nacimiento' => 'sometimes|required|date',
            'fecha_ingreso' => 'sometimes|required|date',
            'salario' => 'sometimes|required|numeric',
            'estado' => 'sometimes|required|boolean',
        ]);

        $empleado->update($data);

        return response()->json($empleado->load('cargo'));
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return response()->json(null, 204);
    }
}

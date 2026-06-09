<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FuncionesCargoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (! $user || ! Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales inválidas.'], 401);
    }

    return ['token' => $user->createToken('api-login-token')->plainTextToken];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('cargos', CargoController::class);
Route::apiResource('empleados', EmpleadoController::class);
Route::apiResource('funciones-cargos', FuncionesCargoController::class);
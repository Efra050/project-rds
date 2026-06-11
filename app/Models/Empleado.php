<?php

namespace App\Models;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model
{
    /** @use HasFactory<\Database\Factories\EmpleadoFactory> */
    use HasFactory;

    protected $fillable = [
        'cargo_id',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'fecha_ingreso',
        'salario',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'salario' => 'float',
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
    ];

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}

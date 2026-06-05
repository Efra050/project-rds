<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Empleado;
use App\Models\FuncionesCargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    /** @use HasFactory<\Database\Factories\CargoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_cargo',
        'descripcion',
    ];

    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class, 'cargo_id');
    }

    public function funcionescargos(): HasMany
    {
        return $this->hasMany(FuncionesCargo::class, 'cargo_id');
    }
}

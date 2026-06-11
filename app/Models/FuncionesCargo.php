<?php

namespace App\Models;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuncionesCargo extends Model
{
    /** @use HasFactory<\Database\Factories\FuncionesCargoFactory> */
    use HasFactory;

    protected $fillable = [
        'cargo_id',
        'descripcion_funcion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}

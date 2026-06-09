<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funciones_cargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->constrained('cargos')->cascadeOnDelete();
            $table->string('descripcion_funcion');
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funciones_cargos');
    }
};

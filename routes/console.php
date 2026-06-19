<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('login:token {email?} {password?}', function (string $email = null, string $password = null) {
    $email = $email ?: $this->ask('Email');
    $password = $password ?: $this->secret('Password');

    $user = User::where('email', $email)->first();

    if (! $user || ! Hash::check($password, $user->password)) {
        $this->error('Credenciales incorrectas.');
        return 1;
    }

    $token = $user->createToken('cli-login-token')->plainTextToken;

    $this->info('Login exitoso.');
    $this->line('Token: '.$token);
    $this->line('Usa este token con el header: Authorization: Bearer '.$token);

    return 0;
})->purpose('Login with email/password and print a Sanctum API token');

use App\Models\Empleado;

Artisan::command('empleados:paginar {page=1} {perPage=5}', function (int $page, int $perPage) {
    $paginator = Empleado::with('cargo')->paginate($perPage, ['*'], 'page', $page);

    $this->info("Página {$paginator->currentPage()} de {$paginator->lastPage()}");
    $this->info("Total de empleados: {$paginator->total()}");
    $this->info("Mostrando {$paginator->count()} registros de {$paginator->perPage()} por página");
    $this->line('');

    foreach ($paginator->items() as $empleado) {
        $this->line("[{$empleado->id}] {$empleado->nombre} {$empleado->apellido} - Cargo: {$empleado->cargo?->nombre} - Salario: {$empleado->salario}");
    }

    return 0;
})->purpose('Muestra empleados paginados desde la consola'); 
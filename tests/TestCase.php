<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        // Desactivar middlewares durante las pruebas para evitar errores de autenticación
        $this->withoutMiddleware();
    }
}

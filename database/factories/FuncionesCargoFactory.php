<?php

namespace Database\Factories;

use App\Models\FuncionesCargo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FuncionesCargo>
 */
class FuncionesCargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $funciones = [
            'Planificación estratégica',
            'Toma de decisiones ejecutivas',
            'Presupuestación y análisis financiero',
            'Control de gastos',
            'Gestión de tesorería',
            'Supervisión de personal',
            'Evaluación de desempeño',
            'Capacitación y desarrollo',
            'Resolución de conflictos',
            'Manejo de herramientas ofimáticas',
            'Análisis de datos',
            'Generación de reportes',
            'Coordinación de proyectos',
            'Gestión de inventarios',
            'Control de calidad',
            'Atención al cliente',
            'Negociación comercial',
            'Prospección de clientes',
            'Seguimiento de cuentas',
            'Mantenimiento de sistemas',
            'Soporte técnico',
            'Actualización de bases de datos',
            'Gestión de documentos',
            'Organización de archivos',
            'Comunicación interna',
            'Elaboración de informes',
            'Presentaciones ejecutivas',
            'Coordinación de reuniones',
            'Gestión de proveedores',
            'Verificación de procedimientos',
            'Cumplimiento normativo',
            'Auditoría interna',
            'Manejo de conflictos laborales',
            'Protección de datos',
            'Seguridad en el trabajo',
            'Mejora continua',
            'Innovación de procesos',
            'Optimización de recursos',
            'Análisis de rentabilidad',
            'Planificación operacional',
            'Coordinación interdepartamental',
            'Mentoreo de personal junior',
            'Capacitación técnica',
            'Actualización de normas',
            'Documentación de procesos',
            'Implementación de mejoras',
            'Vigilancia de métricas',
            'Reporte de KPIs',
            'Gestión de riesgos'
        ];

        return [
            'cargo_id' => \App\Models\Cargo::inRandomOrder()->first()->id ?? 1,
            'descripcion_funcion' => $this->faker->randomElement($funciones),
            'estado' => true,
        ];
    }
}

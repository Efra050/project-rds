<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cargo>
 */
class CargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cargos = [
            'Gerente General', 'Director Financiero', 'Contador', 'Asesor Tributario',
            'Gerente de Operaciones', 'Supervisor de Producción', 'Técnico de Mantenimiento',
            'Ingeniero de Sistemas', 'Programador Senior', 'Programador Junior',
            'Diseñador Gráfico', 'Community Manager', 'Especialista en Marketing',
            'Ejecutivo de Ventas', 'Gerente Comercial', 'Asesor Comercial',
            'Recursos Humanos Manager', 'Coordinador de RRHH', 'Especialista en Nómina',
            'Gerente de Logística', 'Coordinador de Almacén', 'Operator de Almacén',
            'Conductor', 'Recepcionista', 'Asistente Administrativo',
            'Secretaria Ejecutiva', 'Analista de Calidad', 'Supervisor de Calidad',
            'Médico Ocupacional', 'Enfermero', 'Paramédico',
            'Abogado', 'Asesor Legal', 'Notario',
            'Electricista', 'Plomero', 'Albañil',
            'Chef', 'Cocinero', 'Mesero',
            'Barista'
        ];

        $descripcionesBase = [
            'Responsable de la gestión general',
            'Encargado de finanzas y presupuestos',
            'Gestión contable y registro',
            'Asesoría fiscal y tributaria',
            'Supervisión de operaciones',
            'Control de producción',
            'Mantenimiento preventivo y correctivo',
            'Desarrollo de sistemas',
            'Programación de aplicaciones',
            'Desarrollo de código',
            'Creación de diseños visuales',
            'Gestión de redes sociales',
            'Estrategias de marketing',
            'Venta de productos y servicios',
            'Gestión de ventas',
            'Asesoría a clientes',
            'Gestión de personal',
            'Coordinación de recursos humanos',
            'Administración de nómina',
            'Control logístico',
            'Organización de almacenes',
            'Operación de almacén',
            'Transporte de mercancías',
            'Atención al público',
            'Apoyo administrativo',
            'Asistencia a ejecutivos',
            'Control de calidad',
            'Supervisión de procesos',
            'Salud ocupacional',
            'Atención médica',
            'Apoyo médico',
            'Asesoramiento legal',
            'Soporte jurídico',
            'Servicios notariales',
            'Mantenimiento eléctrico',
            'Servicios de plomería',
            'Construcción y reparación',
            'Preparación de alimentos',
            'Cocina general',
            'Servicio al cliente en comidas',
            'Preparación de bebidas'
        ];

        return [
            'nombre_cargo' => $this->faker->unique()->randomElement($cargos),
            'descripcion' => $this->faker->randomElement($descripcionesBase),
        ];
    }
}

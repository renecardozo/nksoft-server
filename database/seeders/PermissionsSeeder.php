<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'visualizar-feriados',
            'crear-feriados',
            'editar-feriados',
            'eliminar-feriados',
            'visualizar-calendario',
            'visualizar-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'visualizar-roles',
            'crear-roles',
            'editar-roles',
            'eliminar-roles',
            'visualizar-materias',
            'crear-materias',
            'visualizar-reserva',
            'crear-reserva',
            'editar-reserva',
            'eliminar-reserva',
            'gestionar-docente',
            'gestionar-solicitudes',
            'buscar-aulas',
            'ver-historial-solicitudes'

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api' 
            ]);
        }
    }
}

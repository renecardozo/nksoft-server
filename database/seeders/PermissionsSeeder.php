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
            'actualizar-aula',
            'registrar-aula',
            'actualizar-unidad',
            'crear-unidad',
            'crear-departamentos',
            'actualizar-materias',
            'registrar-materias',
            'obtener-materias',
            'eliminar-roles',
            'editar-roles',
            'crear-roles',
            'eliminar-usuarios',
            'editar-usuarios',
            'crear-usuarios',
            'eliminar-calendario',
            'editar-calendario',
            'crear-calendario',
             'eliminar-feriados',
             'editar-feriados',
             'crear-feriados',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }
    }
}

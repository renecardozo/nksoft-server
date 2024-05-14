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
            'crear-feriados',
            'editar-feriados',
            'eliminar-feriados',
            'crear-calendario',
            'editar-calendario',
            'eliminar-calendario',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'crear-roles',
            'editar-roles',
            'eliminar-roles',
            'crear-materias',
            'editar-materias',
            'eliminar-materias',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api' 
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
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
            'ver-historial-solicitudes',
        ];
        $role = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'api',
            'state' => true,
        ]);
        $role->syncPermissions($permissions);
        $user = User::create([
            'name' => 'Topo',
            'email' => 'barthg.simpson@mail.ogt',
            'password' => '1234567',
            'last_name' => 'gigio',
            'ci' => '987654321',
            'code_sis' => '201807550',
            'phone' => '234324232',

        ]);
        $user->assignRole('SuperAdmin');
    }
}

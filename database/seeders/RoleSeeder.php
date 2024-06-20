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
        $permissionsDocente = [
            'visualizar-calendario',
            'visualizar-reserva',
            'crear-reserva',
            'editar-reserva',
            'eliminar-reserva',
            'buscar-aulas',
            'notificaciones',
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

        $roleDocente = Role::create([
            'name' => 'Docente',
            'guard_name' => 'api',
            'state' => true,
        ]);
        $roleDocente->syncPermissions($permissionsDocente);
        $userDoc = User::create([
            'name' => 'Patricia',
            'email' => 'patricia@gmail.com',
            'password' => '1234567',
            'last_name' => 'Mercado',
            'ci' => '123456789',
            'code_sis' => '200007550',
            'phone' => '76352617',

        ]);
        $userDoc->assignRole('Docente');
    }
}

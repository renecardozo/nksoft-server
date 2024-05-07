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
       $role= Role::create([
            'name' => 'SuperAdmin',
            'guard_name'=>'api',
            'state'=>true,
        ]);
        $role->syncPermissions($permissions);
        $user= User::create([
            'name' => 'Edgar',
            'email'=>'edgar@gmail.com',
            'password'=>'12345678',
            'last_name'=>'alachi',
            'ci'=>'987654321',
            'code_sis'=>'201807550',
            'phone'=>'234324232',
            
        ]);
        $$user->assignRole('SuperAdmin');
    }
}

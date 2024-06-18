<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartamentoSeeder::class,
            UnidadSeeder::class,
            AulaSeeder::class,
            MateriaSeeder::class,
            PeriodoSeeder::class,
            PermissionsSeeder::class,
            RoleSeeder::class,
            PermissionUnidadesSeeder::class,
            EventsConfigSeeder::class
        ]);
    }
}

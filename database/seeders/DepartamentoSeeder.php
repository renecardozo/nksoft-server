<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Departamento::create([
            'nombreDepartamentos' => 'Química',
        ]);

        Departamento::create([
            'nombreDepartamentos' => 'Física',
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      
        Materia::insert([
            ['id' => '200', 'codigo' => 2215051, 'materia' => 'Redes de computadores', 'grupo' => '5' , 'docente' => 'Jorge Orrellana', 'departamento' => 'informatica-sistemas']
        ]);
        
    }
}

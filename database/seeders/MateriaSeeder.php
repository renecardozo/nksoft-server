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
            ['id' => '200', 'codigo' => 2006063, 'materia' => 'FISICA GENERAL', 'grupo' => 'C' , 'departamento' => 'Física'],
            ['id' => '201', 'codigo' => 2006063, 'materia' => 'FISICA GENERAL', 'grupo' => 'D' , 'departamento' => 'Física'],
            ['id' => '202', 'codigo' => 2006063, 'materia' => 'FISICA GENERAL', 'grupo' => 'E' , 'departamento' => 'Física'],
            ['id' => '203', 'codigo' => 2008019, 'materia' => 'ALGEBRA I', 'grupo' => '10' , 'departamento' => 'Matemática'],
            ['id' => '204', 'codigo' => 2008019, 'materia' => 'ALGEBRA I', 'grupo' => '14 ' , 'departamento' => 'Matemática'],
            ['id' => '205', 'codigo' => 2008054 ,'materia' => 'CALCULO I', 'grupo' => '12' , 'departamento' => 'Matemática'],
            ['id' => '206', 'codigo' => 2008054, 'materia' => 'CALCULO I', 'grupo' => '17' , 'departamento' => 'Matemática'],
            ['id' => '207', 'codigo' => 2010010, 'materia' => 'INTRODUCCION A LA PROGRAMACION', 'grupo' => '1' , 'departamento' => 'Informatica-Sistemas'],
            ['id' => '208', 'codigo' => 2010010, 'materia' => 'INTRODUCCION A LA PROGRAMACION', 'grupo' => '3' , 'departamento' => 'Informatica-Sistemas'],
            ['id' => '209', 'codigo' => 2010016, 'materia' => 'BASE DE DATOS II', 'grupo' => '1' , 'departamento' => 'Informatica-Sistemas'],
            ['id' => '210', 'codigo' => 2016049, 'materia' => 'COSTOS INDUSTRIALES', 'grupo' => '2' , 'departamento' => 'Industrias'],
            ['id' => '211', 'codigo' => 2016052, 'materia' => 'INGENIERIA DE METODOS Y REINGENIERIA', 'grupo' => '2' , 'departamento' => 'Industrias'],
            ['id' => '212', 'codigo' => 2004174, 'materia' => 'QUIMICA INORGANICA', 'grupo' => '1' , 'departamento' => 'Química'],
            ['id' => '213', 'codigo' => 2004174, 'materia' => 'QUIMICA INORGANICA', 'grupo' => '2' , 'departamento' => 'Química'],
            ['id' => '214', 'codigo' => 2004044, 'materia' => 'FISICOQUIMICA', 'grupo' => '1' , 'departamento' => 'Química'],
            ['id' => '215', 'codigo' => 2004044, 'materia' => 'FISICOQUIMICA', 'grupo' => '2' , 'departamento' => 'Química'],

            ['id' => '216', 'codigo' => 2018075, 'materia' => 'RESISTENCIA DE MATERIALES I', 'grupo' => '2' , 'departamento' => 'Civil'],
            ['id' => '217', 'codigo' => 2018075, 'materia' => 'RESISTENCIA DE MATERIALES I', 'grupo' => '3' , 'departamento' => 'Civil'],
            ['id' => '218', 'codigo' => 2012014, 'materia' => 'MECANICA DE SUELOS I', 'grupo' => '1' , 'departamento' => 'Civil'],
            ['id' => '219', 'codigo' => 2012014, 'materia' => 'MECANICA DE SUELOS I', 'grupo' => '2' , 'departamento' => 'Civil'],

        ]); 
        
    }
}

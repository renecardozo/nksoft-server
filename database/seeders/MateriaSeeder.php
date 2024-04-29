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
            ['id' => '200', 'codigo' => 2006063, 'materia' => 'FISICA GENERAL', 'grupo' => 'C' , 'docente' => 'FLORES FLORES FREDDY', 'departamento' => 'Física'],
            ['id' => '201', 'codigo' => 2006063, 'materia' => 'FISICA GENERAL', 'grupo' => 'D' , 'docente' => 'FUENTES MIRANDA IVAN', 'departamento' => 'Física'],
            ['id' => '202', 'codigo' => 2006063, 'materia' => 'FISICA GENERAL', 'grupo' => 'E' , 'docente' => 'MOREIRA CALIZAYA RENE', 'departamento' => 'Física'],
            ['id' => '203', 'codigo' => 2008019, 'materia' => 'ALGEBRA I', 'grupo' => '10' , 'docente' => 'RODRIGUEZ SEJAS JUAN ANTONIO', 'departamento' => 'Matemática'],
            ['id' => '204', 'codigo' => 2008019, 'materia' => 'ALGEBRA I', 'grupo' => '14 ' , 'docente' => 'LEON ROMERO GUALBERTO', 'departamento' => 'Matemática'],
            ['id' => '205', 'codigo' => 2008054 ,'materia' => 'CALCULO I', 'grupo' => '12' , 'docente' => 'DELGADILLO COSSIO DAVID ALFREDO', 'departamento' => 'Matemática'],
            ['id' => '206', 'codigo' => 2008054, 'materia' => 'CALCULO I', 'grupo' => '17' , 'docente' => 'OMONTE OJALVO JOSE ROBERTO', 'departamento' => 'Matemática'],
            ['id' => '207', 'codigo' => 2010010, 'materia' => 'INTRODUCCION A LA PROGRAMACION', 'grupo' => '1' , 'docente' => 'COSTAS JAUREGUI VLADIMIR ABEL', 'departamento' => 'Informatica-Sistemas'],
            ['id' => '208', 'codigo' => 2010010, 'materia' => 'INTRODUCCION A LA PROGRAMACION', 'grupo' => '3' , 'docente' => 'USTARIZ VARGAS HERNAN', 'departamento' => 'Informatica-Sistemas'],
            ['id' => '209', 'codigo' => 2010016, 'materia' => 'BASE DE DATOS II', 'grupo' => '1' , 'docente' => 'APARICIO YUJA TATIANA', 'departamento' => 'Informatica-Sistemas'],
            ['id' => '210', 'codigo' => 2016049, 'materia' => 'COSTOS INDUSTRIALES', 'grupo' => '2' , 'docente' => 'LIMA VACAFLOR TITO ANIBAL', 'departamento' => 'Industrias'],
            ['id' => '211', 'codigo' => 2016052, 'materia' => 'INGENIERIA DE METODOS Y REINGENIERIA', 'grupo' => '2' , 'docente' => 'COSIO PAPADOPOLIS CARLOS JAVIER ALFREDO', 'departamento' => 'Industrias'],
            ['id' => '212', 'codigo' => 2004174, 'materia' => 'QUIMICA INORGANICA', 'grupo' => '1' , 'docente' => 'ARZABE MAURE JOSE OMAR', 'departamento' => 'Química'],
            ['id' => '213', 'codigo' => 2004174, 'materia' => 'QUIMICA INORGANICA', 'grupo' => '2' , 'docente' => 'GONZALES CARTAGENA LUCIO', 'departamento' => 'Química'],
            ['id' => '214', 'codigo' => 2004044, 'materia' => 'FISICOQUIMICA', 'grupo' => '1' , 'docente' => 'ARCE GARCIA OMAR ORLANDO', 'departamento' => 'Química'],
            ['id' => '215', 'codigo' => 2004044, 'materia' => 'FISICOQUIMICA', 'grupo' => '2' , 'docente' => 'ROJAS CESPEDES JENNY', 'departamento' => 'Química'],

            ['id' => '216', 'codigo' => 2018075, 'materia' => 'RESISTENCIA DE MATERIALES I', 'grupo' => '2' , 'docente' => 'GOMEZ UGARTE GUIDO', 'departamento' => 'Civil'],
            ['id' => '217', 'codigo' => 2018075, 'materia' => 'RESISTENCIA DE MATERIALES I', 'grupo' => '3' , 'docente' => 'FLORES GARCIA HERNAN', 'departamento' => 'Civil'],
            ['id' => '218', 'codigo' => 2012014, 'materia' => 'MECANICA DE SUELOS I', 'grupo' => '1' , 'docente' => 'SALINAS PEREIRA LUIS MAURICIO', 'departamento' => 'Civil'],
            ['id' => '219', 'codigo' => 2012014, 'materia' => 'MECANICA DE SUELOS I', 'grupo' => '2' , 'docente' => 'HEREDIA SOLIZ WILSON', 'departamento' => 'Civil'],

        ]); 
        
    }
}

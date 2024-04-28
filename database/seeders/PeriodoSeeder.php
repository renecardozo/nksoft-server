<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
            // Insertar los periodos en la base de datos
            Periodo::insert([
                ['horaInicio' => '6:45', 'horaFin' => '8:15', 'numero_periodo' => 1],
                ['horaInicio' => '8:15', 'horaFin' => '9:45', 'numero_periodo' => 2],
                ['horaInicio' => '9:45', 'horaFin' => '11:15', 'numero_periodo' => 3],
                ['horaInicio' => '11:15', 'horaFin' => '12:45', 'numero_periodo' => 4],
                ['horaInicio' => '12:45', 'horaFin' => '14:15', 'numero_periodo' => 5],
                ['horaInicio' => '14:15', 'horaFin' => '15:45', 'numero_periodo' => 6],
                ['horaInicio' => '15:45', 'horaFin' => '17:15', 'numero_periodo' => 7],
                ['horaInicio' => '17:15', 'horaFin' => '18:45', 'numero_periodo' => 8],
                ['horaInicio' => '18:45', 'horaFin' => '20:15', 'numero_periodo' => 9],
                ['horaInicio' => '20:15', 'horaFin' => '21:45', 'numero_periodo' => 10],
            ]);
        }
    }
<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Unidad;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear una nueva unidad
        Unidad::create([
            'departamento_id' => 26,
            'nombreUnidades' => 'Departamento de Informática y Sistemas',
            'horaAperturaUnidades' => '08:15:00',
            'horaCierreUnidades' => '20:15:00'
        ]);
        Unidad::create([
            'departamento_id' => 27,
            'nombreUnidades' => 'Edificio Elektro',
            'horaAperturaUnidades' => '08:15:00',
            'horaCierreUnidades' => '20:15:00'
        ]);
        Unidad::create([
            'nombreUnidades' => 'Edificio Académico 2',
            'horaAperturaUnidades' => '06:45:00',
            'horaCierreUnidades' => '21:45:00'
        ]);
        
        Unidad::create([
            'departamento_id' => 25,
            'nombreUnidades' => 'Departamento de Física',
            'horaAperturaUnidades' => '06:45:00',
            'horaCierreUnidades' => '18:45:00'
        ]);
        Unidad::create([
            'nombreUnidades' => 'Edificio de Laboratorios Básicos',
            'horaAperturaUnidades' => '06:45:00',
            'horaCierreUnidades' => '18:45:00'
        ]);
    }
}

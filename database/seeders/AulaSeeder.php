<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed para un aula
        Aula::create([
            'unidad_id' => 103, 
            'nombreAulas' => 'Laboratorio de cómputo 1',
            'capacidadAulas' => '50', 
        ]);
        Aula::create([
            'unidad_id' => 103, 
            'nombreAulas' => 'Laboratorio de cómputo 2',
            'capacidadAulas' => '50', 
        ]);
        Aula::create([
            'unidad_id' => 103, 
            'nombreAulas' => 'Laboratorio de redes',
            'capacidadAulas' => '40', 
        ]);
        Aula::create([
            'unidad_id' => 103, 
            'nombreAulas' => 'Laboratorio de mantenimiento',
            'capacidadAulas' => '45', 
        ]);
        Aula::create([
            'unidad_id' => 103, 
            'nombreAulas' => 'Laboratorio de desarrollo',
            'capacidadAulas' => '50', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 1',
            'capacidadAulas' => '70', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 2',
            'capacidadAulas' => '70', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 3',
            'capacidadAulas' => '75', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 4',
            'capacidadAulas' => '90', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 5',
            'capacidadAulas' => '80', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 6',
            'capacidadAulas' => '70', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula Lab Elektro 7',
            'capacidadAulas' => '70', 
        ]);
        Aula::create([
            'unidad_id' => 104, 
            'nombreAulas' => 'Aula control',
            'capacidadAulas' => '70', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 A',
            'capacidadAulas' => '250', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 B',
            'capacidadAulas' => '250', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 C',
            'capacidadAulas' => '150', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 D',
            'capacidadAulas' => '150', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 E',
            'capacidadAulas' => '200', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 F',
            'capacidadAulas' => '200', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 G',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '691 H',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '692 A',
            'capacidadAulas' => '250', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '692 B',
            'capacidadAulas' => '250', 
        ]);
        Aula::create([
            'unidad_id' => 105, 
            'nombreAulas' => '692 C',
            'capacidadAulas' => '150', 
        ]);
        Aula::create([
            'unidad_id' => 107, 
            'nombreAulas' => 'Aula Lab Fisica 1',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 107, 
            'nombreAulas' => 'Aula Lab Fisica 2',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 107, 
            'nombreAulas' => 'Aula Lab Fisica 3',
            'capacidadAulas' => '150', 
        ]);
        Aula::create([
            'unidad_id' => 107, 
            'nombreAulas' => 'Aula Lab Fisica 4',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 107, 
            'nombreAulas' => 'Aula Lab Fisica 5',
            'capacidadAulas' => '120', 
        ]);
        Aula::create([
            'unidad_id' => 107, 
            'nombreAulas' => 'Aula Lab Fisica 6',
            'capacidadAulas' => '140', 
        ]);
        Aula::create([
            'unidad_id' => 108, 
            'nombreAulas' => 'Laboratorio Fisica 1',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 108, 
            'nombreAulas' => 'Laboratorio Fisica 3',
            'capacidadAulas' => '100', 
        ]);
        Aula::create([
            'unidad_id' => 108, 
            'nombreAulas' => 'Laboratorio Fisica 2',
            'capacidadAulas' => '100', 
        ]);
    }
}

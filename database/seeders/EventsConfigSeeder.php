<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EventsConfig;

class EventsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventsConfig::create(
        [
            'name' => 'Feriado Institucional',
            'code' => 'COD_0001',
            'color' => 'primary',
            'hex_color' => '#6261cc',
        ]);

        EventsConfig::create([
            'name' => 'Feriado Local',
            'code' => 'COD_0002',
            'color' => 'info',
            'hex_color' => '#3d99ff',
        ]);
        EventsConfig::create([
            'name' => 'Feriado Nacional',
            'code' => 'COD_0003',
            'color' => 'success',
            'hex_color' => '#249542',
        ]);
        EventsConfig::create([
            'name' => 'Foraneo',
            'code' => 'COD_0004',
            'color' => 'secondary',
            'hex_color' => '#6b7785',
        ]);
    }
}

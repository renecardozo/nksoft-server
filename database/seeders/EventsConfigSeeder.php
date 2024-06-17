<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events_config')->insert([
            [
                'name' => 'Feriado Institucional',
                'code' => 'COD_0001',
                'color' => 'primary',
                'hex_color' => '#6261cc',
            ],
            [
                'name' => 'Feriado Local',
                'code' => 'COD_0002',
                'color' => 'info',
                'hex_color' => '#3d99ff',
            ],
            [
                'name' => 'Feriado Nacional',
                'code' => 'COD_0003',
                'color' => 'success',
                'hex_color' => '#249542',
            ],
            [
                'name' => 'Foraneo',
                'code' => 'COD_0004',
                'color' => 'secondary',
                'hex_color' => '#6b7785',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ConfHorasExtra;
use Illuminate\Database\Seeder;

class ConfHorasExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfHorasExtra::create([
            'tipo_hora_extra'   => 'DE 14 A 22',
            'factor_calculo'   => 0.30,
            'estado'   => 'HABILITADO',
        ]);
        ConfHorasExtra::create([
            'tipo_hora_extra'   => 'DE 22 A 06',
            'factor_calculo'   => 0.30,
            'estado'   => 'HABILITADO',
        ]);
        ConfHorasExtra::create([
            'tipo_hora_extra'   => 'HORAS EXTRA NOCTURNO',
            'factor_calculo'   => 2.00,
            'estado'   => 'HABILITADO',
        ]);
        ConfHorasExtra::create([
            'tipo_hora_extra'   => 'HORAS EXTRA',
            'factor_calculo'   => 2.00,
            'estado'   => 'HABILITADO',
        ]);
        ConfHorasExtra::create([
            'tipo_hora_extra'   => 'DOMINGOS',
            'factor_calculo'   => 2.00,
            'estado'   => 'HABILITADO',
        ]);
        ConfHorasExtra::create([
            'tipo_hora_extra'   => 'DE 15 A 07',
            'factor_calculo'   => 0.30,
            'estado'   => 'HABILITADO',
        ]);
    }
}

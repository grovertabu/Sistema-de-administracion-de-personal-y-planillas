<?php

namespace Database\Seeders;

use App\Models\ConfBonoAntiguedad;
use Illuminate\Database\Seeder;

class ConfBonoAntiguedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfBonoAntiguedad::create([
            'anio_i'   => '2',
            'anio_f'   => '4',
            'porcentaje'   => '5',
            'estado'   => 'HABILITADO',
        ]);
        ConfBonoAntiguedad::create([
            'anio_i'   => '5',
            'anio_f'   => '7',
            'porcentaje'   => '11',
            'estado'   => 'HABILITADO',
        ]);
        ConfBonoAntiguedad::create([
            'anio_i'   => '8',
            'anio_f'   => '10',
            'porcentaje'   => '18',
            'estado'   => 'HABILITADO',
        ]);
        ConfBonoAntiguedad::create([
            'anio_i'   => '11',
            'anio_f'   => '14',
            'porcentaje'   => '26',
            'estado'   => 'HABILITADO',
        ]);
        ConfBonoAntiguedad::create([
            'anio_i'   => '15',
            'anio_f'   => '19',
            'porcentaje'   => '34',
            'estado'   => 'HABILITADO',
        ]);
        ConfBonoAntiguedad::create([
            'anio_i'   => '20',
            'anio_f'   => '24',
            'porcentaje'   => '42',
            'estado'   => 'HABILITADO',
        ]);
        ConfBonoAntiguedad::create([
            'anio_i'   => '25',
            'anio_f'   => '60',
            'porcentaje'   => '50',
            'estado'   => 'HABILITADO',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Estructura_Organizacional;
use Illuminate\Database\Seeder;

class EstructuraOrganizacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Estructura_Organizacional::create([
            'nombre'    => 'ELAPAS 2022',
            'version'   => 1,
            'estado'    => 'ACTIVO',
        ]);
    }
}

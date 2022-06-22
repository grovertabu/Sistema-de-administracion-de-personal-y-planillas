<?php

namespace Database\Seeders;

use App\Models\Tipo_Contrato;
use Illuminate\Database\Seeder;

class TipoContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_Contrato::create([
            'nombre'   => 'ITEM',
            'estado'   => 'ACTIVO',
        ]);
        Tipo_Contrato::create([
            'nombre'   => 'CONSULTOR',
            'estado'   => 'ACTIVO',
        ]);
        Tipo_Contrato::create([
            'nombre'   => 'EVENTUAL',
            'estado'   => 'ACTIVO',
        ]);
        // Tipo_Contrato::create([
        //     'nombre'   => 'PAE',
        //     'estado'   => 'ACTIVO',
        // ]);
    }
}

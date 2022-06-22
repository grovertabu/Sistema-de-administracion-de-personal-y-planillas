<?php

namespace Database\Seeders;

use App\Models\ConfImpositiva;
use Illuminate\Database\Seeder;

class ConfImpositivaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfImpositiva::create([
            'salario_minimo'   => '2250',
            'cantidad_salario_minimo'   => '2',
            'porcentaje_impositiva'   => '13',
            'estado'   => 'HABILITADO',
        ]);
    }
}

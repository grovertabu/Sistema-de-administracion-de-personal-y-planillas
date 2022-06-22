<?php

namespace Database\Seeders;

use App\Models\Unidad_organizacional;
use Illuminate\Database\Seeder;

class UnidadOrganizacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Unidad_organizacional::create([
            'seccion'                       => 'GERENCIA GENERAL',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'GERENCIA TECNICA',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'CATASTRO DE REDES',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'CAPTACION Y ADUCCION',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'PLANTA POTABILIZADORA DE AGUA',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'CONTROL DE CALIDAD',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'RED DE AGUA POTABLE',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'INSTALACION Y CONEXIONES',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'RED DE ALCANTARILLADO',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'PLANTA DE TRATAMIENTO Y AGUAS RESIDUALES',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'GERENCIA ADMINISTRATIVA Y FINANCIERA',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
        Unidad_organizacional::create([
            'seccion'                       => 'GERENCIA COMERCIAL',
            'estructura_organizacional_id'  => 1,
            'estado'                        => 'ACTIVO'
        ]);
    }
}

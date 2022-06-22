<?php

namespace Database\Seeders;

use App\Models\Escala_salarial;
use Illuminate\Database\Seeder;

class EscalaSalarialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Escala_salarial::create([
            'nivel'                        => '1',
            'descripcion'                  => 'GERENCIA GENERAL',
            'casos'                        => 1,
            'salario_mensual'              => 17827,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '2',
            'descripcion'                  => 'GERENCIAS DE AREA',
            'casos'                        => 3,
            'salario_mensual'              => 14134,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '3',
            'descripcion'                  => 'JEFES DE UNIDAD',
            'casos'                        => 14,
            'salario_mensual'              => 11415,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '4',
            'descripcion'                  => 'TECNICOS DE PLANTA, OPERAC Y MANT PRESUP',
            'casos'                        => 13,
            'salario_mensual'              => 9695,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '5',
            'descripcion'                  => 'RESP. ACTIVOS FIJOS, ADQUISIC. ALMACEN, RR.PP',
            'casos'                        => 11,
            'salario_mensual'              => 8547,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '6',
            'descripcion'                  => 'CAJEROS, HABILITADO, MECANICO, ODECO, AUX, AS. JURIDICO',
            'casos'                        => 13,
            'salario_mensual'              => 7221,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '7',
            'descripcion'                  => 'SECRETARIA, CAPATACES, CHOFER, INSPECTORES',
            'casos'                        => 32,
            'salario_mensual'              => 6337,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '8',
            'descripcion'                  => 'LECTURADOR, OPERADOR VALVULAS, ARCHIVO',
            'casos'                        => 21,
            'salario_mensual'              => 5632,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '9',
            'descripcion'                  => 'ALBANIL, OPERADOR, PLOMERO, PORTERO',
            'casos'                        => 49,
            'salario_mensual'              => 5075,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
        Escala_salarial::create([
            'nivel'                        => '10',
            'descripcion'                  => 'PEONES, ENCARGADOS SISTEMA DE BOMBEO',
            'casos'                        => 41,
            'salario_mensual'              => 4742,
            'estructura_organizacional_id' => 1,
            'estado'                       => 'ACTIVO',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfAportesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_aportes')->delete();
        
        \DB::table('conf_aportes')->insert(array (
            0 => 
            array (
                'tipo_aporte' => 'APORTE SOLIDARIO DEL ASEGURADO',
                'rango_inicial' => '1.00',
                'rango_final' => '100000.00',
                'porcentaje_aporte' => '0.50',
                'estado' => 'HABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'tipo_aporte' => 'COTIZACION MENSUAL',
                'rango_inicial' => '1.00',
                'rango_final' => '100000.00',
                'porcentaje_aporte' => '10.00',
                'estado' => 'HABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'tipo_aporte' => 'PRIMA RIESGO COMUN',
                'rango_inicial' => '1.00',
                'rango_final' => '100000.00',
                'porcentaje_aporte' => '1.71',
                'estado' => 'HABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'tipo_aporte' => 'COMISION AL ENTE ADMINISTRADOR',
                'rango_inicial' => '1.00',
                'rango_final' => '100000.00',
                'porcentaje_aporte' => '0.50',
                'estado' => 'HABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'tipo_aporte' => 'APORTE NACIONAL SOLIDARIO DESDE 13000 HASTA 25000',
                'rango_inicial' => '13000.00',
                'rango_final' => '25000.00',
                'porcentaje_aporte' => '1.00',
                'estado' => 'HABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'tipo_aporte' => 'APORTE NACIONAL SOLIDARIO DESDE DE 25000 HASTA 35000',
                'rango_inicial' => '25000.00',
                'rango_final' => '35000.00',
                'porcentaje_aporte' => '5.00',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'tipo_aporte' => 'APORTE NACIONAL SOLIDARIO DESDE 35000 ADELANTE',
                'rango_inicial' => '35000.00',
                'rango_final' => '100000.00',
                'porcentaje_aporte' => '10.00',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
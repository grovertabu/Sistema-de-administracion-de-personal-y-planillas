<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NombrePlanillasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nombre_planillas')->delete();
        
        \DB::table('nombre_planillas')->insert(array (
            0 => 
            array (
                'mes' => 1,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA ENERO',
                'fecha_creacion' => '2022-01-31',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:00:13',
                'updated_at' => '2022-08-16 10:00:13',
            ),
            1 => 
            array (
                'mes' => 2,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA FEBRERO',
                'fecha_creacion' => '2022-02-28',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:00:34',
                'updated_at' => '2022-08-16 10:00:34',
            ),
            2 => 
            array (
                'mes' => 3,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA MARZO',
                'fecha_creacion' => '2022-03-31',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:01:02',
                'updated_at' => '2022-08-16 10:01:02',
            ),
            3 => 
            array (
                'mes' => 4,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA ABRIL',
                'fecha_creacion' => '2022-04-30',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:01:24',
                'updated_at' => '2022-08-16 10:01:24',
            ),
            4 => 
            array (
                'mes' => 5,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA MAYO',
                'fecha_creacion' => '2022-05-31',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:01:44',
                'updated_at' => '2022-08-16 10:01:44',
            ),
            5 => 
            array (
                'mes' => 6,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA JUNIO',
                'fecha_creacion' => '2022-06-30',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:02:04',
                'updated_at' => '2022-08-16 10:02:04',
            ),
            6 => 
            array (
                'mes' => 7,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA JULIO',
                'fecha_creacion' => '2022-07-31',
                'estado' => 'ACTIVO',
                'created_at' => '2022-08-16 10:02:18',
                'updated_at' => '2022-08-16 10:02:18',
            ),
            7 => 
            array (
                'mes' => 8,
                'gestion' => 2022,
                'tipo_contrato' => 1,
                'nombre_planilla' => 'PLANILLA DE SALARIOS MENSUAL DE PLANTA AGOSTO 2022',
                'fecha_creacion' => '2022-08-31',
                'estado' => 'ACTIVO',
                'created_at' => '2022-09-07 09:22:01',
                'updated_at' => '2022-09-07 09:22:01',
            ),
        ));
        
        
    }
}
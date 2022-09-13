<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfDescuentosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_descuentos')->delete();
        
        \DB::table('conf_descuentos')->insert(array (
            0 => 
            array (
                'nombre_descuento' => 'FONDO SOCIAL',
                'estado' => 'HABILITADO',
                'created_at' => '2022-08-12 12:39:37',
                'updated_at' => '2022-08-12 12:39:37',
            ),
            1 => 
            array (
                'nombre_descuento' => 'ENTIDADES FINANCIERAS',
                'estado' => 'HABILITADO',
                'created_at' => '2022-08-12 12:40:02',
                'updated_at' => '2022-08-12 12:40:02',
            ),
            2 => 
            array (
                'nombre_descuento' => 'RETENCION JUDICIAL',
                'estado' => 'HABILITADO',
                'created_at' => '2022-08-12 12:40:14',
                'updated_at' => '2022-08-12 12:40:14',
            ),
        ));
        
        
    }
}
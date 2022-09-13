<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfOtroDescuentosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_otro_descuentos')->delete();
        
        \DB::table('conf_otro_descuentos')->insert(array (
            0 => 
            array (
                'descripcion' => 'APOYO SOLIDARIO COMPAÑERO F. SAIGUA MEDIO DIA DE HABER',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'descripcion' => 'APOYO SOLIDARIO COMPAÑERO FALLECIDO YERI CERVANTES MEDIO DIA DE HABER',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'descripcion' => 'AYUDA SOLIDARIA POR FALLECIMIENTO MAMA COMPAÑERA NANCY NUÑES Y EPIFANIO ARENALES',
                'factor_calculado' => '*0+30',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'descripcion' => 'APORTE POR CORONAVIRUS NO SINDICALIZADOS UN DIA DE HABER',
                'factor_calculado' => '/30',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'descripcion' => 'APORTE POR CORONAVIRUS SINDICALIZADOS MEDIO DIA DE HABER',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'descripcion' => 'APORTE POR FALLECIMIENTO MAMA JUAN ROJAS Y AGUSTIN CRUZ 30 BS',
                'factor_calculado' => '*0+30',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'descripcion' => 'APORTE POR FALLECIMIENTO MAMA MARCELO CHAMOSO Y PAPA DE ABEL CONDORI 30 BS',
                'factor_calculado' => '*0+30',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO FALLECIMIENTO PAPA WEIMAR BAYO 15 BS',
                'factor_calculado' => '*0+15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR FALLECIMIENTO PAPA GREGORIO ILLANES Y MAMA JUAN PABLO DURAN',
                'factor_calculado' => '*0+30',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR FALLECIMIENTO DE MARCELO CHAMOSO',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACION SERGIO TORREZ',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACION EMILIO ESCALERA USTAREZ MEDIO DIA DE HABER',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACION GERARDO VARGAS MEDIO DIA DE HABER',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACION MEDIO DE HABER VIRGINIA OVANDO',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'descripcion' => 'APORTE POR JUBILACION AL TRABAJADOR SEVERO SERRUDO MEDIO DIA DE HABER',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACION DE LUCIANO CONDORI ',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR FALLECIMIENTO DEL ESPOSO Y PAPA DE ELIZABETH BRITO MEDIO DIA Y 15 BS',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'descripcion' => 'APORTE POR JUBILACION COMPAÑERA TERESA TIRADO MEDIO DIA DE HABER BASICO',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACIÓN DE HECTOR PAREDES MEDIO DIA DE HABER BASICO',
                'factor_calculado' => '/30*0.5',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'descripcion' => 'APORTE POR JUBILACIÓN DEL TRABAJADOR NICOLAS CONTRERAS MEDIO DIA DE HABER Y POR FALLECIMIENTO DEL PAPA DE ORLANDO VIÑAYA 15 BS',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'descripcion' => 'AYUDA SOLIDARIA POR JUBILACION CIRO BARAHONA Y POR FALLECIMIENTO PAPA DE ALEJANDRO SANCHEZ',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR JUBILACIÓN DE JOAQUIN CHAVEZ Y APORTE POR FALLECIMIENTO MAMA DE ANACLETO LOPEZ 15 BS',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'descripcion' => 'APORTE MEDIO DIA DE HABER POR FALLECIMIENTO DEL COMPAÑERO KENY FUENTES Y 15 BS POR FALLECIMIENTO DE MAMA DE COMPAÑERO MAQUIRA',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'descripcion' => 'DESCUENTO SOLIDARIO POR JUBILACION ORLANDO VIÑAYA MEDIO DIA DE HABER Y 15 BS DESCUENTO POR FALLECIMIENTO MAMA DE GUILDEN GALLARDO',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'descripcion' => 'APORTE POR JUBILACION DE RUBEN DE TEZANOS PINTO Y 15 BS POR FALLECIMIENTO PAPA MARCELINO MIRANDA',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'descripcion' => 'APORTE 15 BS FALLECIMIENTO MAMA PAULINO FLORES, 15 BS PAPA PERCY ALCOCER, 30 BS FALLECIMIENTO HIJA RICARDO ONDARZA Y 30 BS AYUDA SOLIDARIA WEIMAR ESTIVAREZ',
                'factor_calculado' => '*0+90',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR FALLECIMIENTO DE MAMA ALVARO CAMPOS 15 BS Y FALLECIMIENTO MAMA JULIAN AGUILAR 15 BS Y APOYO SOLIDARIO PARA HIJO FRANCISCO DURAN 30 BS',
                'factor_calculado' => '*0+60',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO JUBILACION DE SABINO CHAVEZ MEDIO DIA DE HABER Y 15 BS FALLECIMIENTO PAPA ANGELICA BAPTISTA',
                'factor_calculado' => '/30*0.5 + 15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'descripcion' => 'APORTE SOLIDARIO POR FALLECIMIENTO DEL PAPA DEL COMPAÑERO LUIS BELTRAN ACUÑA 15 BS',
                'factor_calculado' => '*0+15',
                'estado' => 'INHABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'descripcion' => 'DESCUENTO SOLIDARIO POR JUBILACION DEL COMPAÑERO BASILIO MOSTACEDO',
                'factor_calculado' => '/30*0.5',
                'estado' => 'HABILITADO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
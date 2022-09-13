<?php

use Illuminate\Support\Collection;

use Carbon\Carbon;

class Funciones
{
    public static function now()
    {
        $now =  Carbon::now()->format('d-m-Y');
        return $now;
    }

    public static function calcular_edad($fecha_actual, $fecha_nacimiento){
        list($ano,$mes,$dia) = explode("-",$fecha_nacimiento);
        $ano_diferencia  = date('Y',strtotime($fecha_actual)) - $ano;
        $mes_diferencia = date('m',strtotime($fecha_actual)) - $mes;
        $dia_diferencia   = date('d',strtotime($fecha_actual)) - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;
        return $ano_diferencia;
    }

    public static function mesPasado($mes)
    {
        // $mes = Carbon::now()->format('m') - 1;
        $mes_pasado =  Carbon::now()->subMonth()->format('Y-m-d');
        $anio = Carbon::now()->format('Y');
        $mesPasa = Carbon::create($anio,$mes,1);
        return $mesPasa;
    }
    public static function expedido_value($departamento)
    {
        $departamentos = [
            'CHUQUISACA' => 'CH',
            'LA PAZ'     => 'LP',
            'COCHABAMBA' => 'CB',
            'ORURO'      => 'OR',
            'POTOSI'     => 'PT',
            'TARIJA'     => 'TJ',
            'SANTA CRUZ' => 'SC',
            'BENI'       => 'BE',
            'PANDO'      => 'PD',
        ];
        return array_search($departamento, $departamentos);
    }

    public static function getDia($posicion)
    {
        $dias = array(
            1 => "Lunes",
            2 => "Martes",
            3 => "Miercoles",
            4 => "Jueves",
            5 => "Viernes",
            6 => "Sábado",
            7 => "Domingo"
        );
        return $dias[$posicion];
    }

    public static function getMes($posicion)
    {
        $meses = array(
            1 => "Enero",
            2 => "Febrero",
            3 => "Marzo",
            4 => "Abril",
            5 => "Mayo",
            6 => "Junio",
            7 => "Julio",
            8 => "Agosto",
            9 => "Septiembre",
            10 => "Octubre",
            11 => "Noviembre",
            12 => "Diciembre"
        );
        return $meses[$posicion];
    }

    public static function diferenciafechas($fecha_ini, $fecha_fin)
    {
        $f1 = strtotime($fecha_ini);
        $f2 = strtotime($fecha_fin);

        $year1 = date('Y', $f1);
        $year2 = date('Y', $f2);

        $month1 = date('m', $f1);
        $month2 = date('m', $f2);

        $day1 = date('d', $f1);
        $day2 = date('d', $f2);

        $anios = $year2 - $year1;
        $meses = $month2 - $month1;
        $dias = $day2 - $day1;

        if ($dias < 0) {
            $dias = 30 + $dias;
            $rest_mes = 1;
            if ($meses < 0) {
                $meses = 12 + $meses - $rest_mes;
                $rest_anio = 1;
                if ($anios == 0) {
                    $anios = 0;
                } else {
                    $anios = $anios - $rest_anio;
                }
            } else {
                if ($meses == 0) {
                }
            }
        }
        if ($dias == 0) {
            $dias = 0;
            $inc_mes = 1;
        }

        // $datos = array($f1, $f2, $year1, $year2, $month1, $month2);
        $cantidad = array($anios, $meses, $dias); //, $fecha_ini, $fecha_fin
        // return $datos;
        return $cantidad;
    }
    public static function sumar_antiguedad($anterior, $nuevo) //$anterior (array),$nuevo (array),
    {
        $sum_dias = $anterior[2] + $nuevo[2];

        $sum_anios = $anterior[0] + $nuevo[0];

        if ($sum_dias < 30) {
            $actual[2] = $sum_dias;
            $mes = 0;
        } else {
            $actual[2] = $sum_dias % 30;
            $mes = 1;
        }
        $sum_meses = $anterior[1] + $nuevo[1] + $mes;
        if ($sum_meses < 12) {
            $actual[1] = $sum_meses;
            $anio = 0;
        } else {
            $actual[1] = $sum_meses % 12;
            $anio = 1;
        }
        $sum_anios = $anterior[0] + $nuevo[0] + $anio;
        $actual[0] = $sum_anios;
        return $actual;
    }
    // public static function antiguedad($startDate, $endDate)
    // {
    //     $startDate = strtotime($startDate);
    //     $endDate   = strtotime($endDate);
    //     if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate)
    //         return false;
    //     $years = date('Y', $endDate) - date('Y', $startDate);

    //     $endMonth = date('m', $endDate);
    //     $startMonth = date('m', $startDate);

    //     // Calculate months
    //     $months = $endMonth - $startMonth;
    //     if ($months <= 0) {
    //         $months += 12;
    //         $years--;
    //     }
    //     if ($years < 0)
    //         return false;

    //     // Calculate the days
    //     $offsets = array();
    //     if ($years > 0)
    //         $offsets[] = $years . (($years == 1) ? ' year' : ' years');
    //     if ($months > 0)
    //         $offsets[] = $months . (($months == 1) ? ' month' : ' months');
    //     $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now';

    //     $days = $endDate - strtotime($offsets, $startDate);
    //     $days = date('d', $days);
    //     // $days = $days + 0;

    //     return array($years, $months, $days);//, $startDate, $endDate
    //     // return array($day_result, $ney_day, $mounth_result);
    // }
    public static function antiguedad($startDate, $endDate)
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate)
            return false;

        $years = date('Y', $endDate) - date('Y', $startDate);
        $endMonth = date('m', $endDate);
        $startMonth = date('m', $startDate);


        // Calculate months
        $months = $endMonth - $startMonth;

        if ($months <= 0) {
            $months += 12;
            $years--;
        }

        if ($years < 0)
            return array(0, 0, 0);

        // Calculate the days
        $offsets = array();
        if ($years > 0)
            $offsets[] = $years . (($years == 1) ? ' year' : ' years');
        if ($months > 0)
            $offsets[] = $months . (($months == 1) ? ' month' : ' months');
        $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now';

        $days = $endDate - strtotime($offsets, $startDate);
        $days = date('z', $days);
        return array($years, $months, $days);
    }

    // public static function antiguedades($startDate, $endDate)
    // {
    //     $startDate = new DateTime($startDate);
    //     $endDate   = new DateTime($endDate);
    //     $result = $startDate->diff($endDate);

    //     $str = '';
    //     $str .= ($result->invert == 1) ? ' - ' : '';
    //     return array($result->y, $result->m, $result->d);
    // }

    public static function formatDate($date){
        return date('d-m-Y', strtotime($date));
    }
    public static function formatMoney($number)
    {
        return number_format($number, 2, ",", ".");
    }

    public static function genero($key)
    {
        $sexo = [
            'M' => 'MASCULINO',
            'F' => 'FEMENINO',
        ];
        return $sexo[$key];
    }
    public static function estadoCivil($gen,$estado)
    {
        if ($gen == 'M') {
            $estados = [
                'NONE' => 'SIN ESPECIFICAR',
                'SINGLE' => 'SOLTERO',
                'MARRIED' => 'CASADO',
                'WIDOWER' => 'VIUDO',
                'DIVORCED' => 'DIVORCIADO',
            ];
            return $estados[$estado];
        } else {
            $estados = [
                'NONE' => 'SIN ESPECIFICAR',
                'SINGLE' => 'SOLTERA',
                'MARRIED' => 'CASADA',
                'WIDOWER' => 'VIUDA',
                'DIVORCED' => 'DIVORCIADA',
            ];
            return $estados[$estado];
        }
    }

    public static function calcula_edad($fecha_nacimiento){
    $edad = Carbon::parse($fecha_nacimiento)->age;
    return $edad;
    }

    public static function fecha_text($anio,$mes,$dia){
        $anio = $anio == 1 ? $anio.' año ' : $anio.' años ';
        $mes = $mes == 1 ? $mes.' mes ' : $mes.' meses ';
        $dia = $dia == 1 ? $dia.' día ' : $dia.' días ';
        return $anio.$mes.$dia;
    }

}

// FUnciones globales
function ahora()
{
    $now =  Carbon::now()->format('d-m-Y');
    return $now;
}




function formatMoney($number)
{
    return number_format($number, 2, ",", ".") . " Bs";
}

function formatNumber($number)
{
    return number_format($number, 2, ".", ",");
}

function edad($fecha_nacimiento)
{
    $edad = Carbon::parse($fecha_nacimiento)->age;
    return $edad;
}

function expedido_key($departamento)
{
    $departamentos = [
        'CH' => 'CHUQUISACA',
        'LP' => 'LA PAZ',
        'CB' => 'COCHABAMBA',
        'OR' => 'ORURO',
        'PT' => 'POTOSI',
        'TJ' => 'TARIJA',
        'SC' => 'SANTA CRUZ',
        'BE' => 'BENI',
        'PD' => 'PANDO',
    ];
    return array_search($departamento, $departamentos);
}

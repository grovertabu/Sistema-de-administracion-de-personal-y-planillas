<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Funciones;
use Illuminate\Support\Facades\DB;

class Planilla extends Model
{
    protected $table = 'planillas';

    protected $casts = [
        'fecha_ingreso' => 'date:d-m-Y',
        'fecha_aprobado' => 'date:d-m-Y',
    ];

    protected $guarded = [];


    public function resumen_total_planilla($nombre_planilla)
    {
        $nomina_cargos = DB::table('nomina_cargos as nc')
            ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->select(
                'nc.id as id_cargo',
                'u.seccion',
                'c.nombre as nombre_cargo',
                'nc.item as item',
                'nc.estado as estado_cargo'
            )
            ->orderBy('nc.item')->get();

        $consulta_asistencia = DB::table('planilla_asistencias')->where([
            ['mes', '=', $nombre_planilla->mes],
            ['gestion', '=', $nombre_planilla->gestion],
            ['tipo_contrato', '=', $nombre_planilla->tipo_contrato],
        ])->get();
        // ASISTENCIAS
        $ids_asistencias = $consulta_asistencia->pluck('asignacion_cargo_id')->toArray();

        foreach ($nomina_cargos as $cargo) {
            $cargo_id = $cargo->id_cargo;
            $search_cargo = DB::table('asignacion_cargos')
                ->join('planilla_asistencias', 'planilla_asistencias.asignacion_cargo_id', 'asignacion_cargos.id')
                ->where([
                    ['mes', '=', $nombre_planilla->mes],
                    ['gestion', '=', $nombre_planilla->gestion],
                    ['tipo_contrato', '=', $nombre_planilla->tipo_contrato],
                ])
                ->whereIn('asignacion_cargos.nomina_cargo_id', function ($query) use ($cargo_id) {
                    $query->select('id')->from('nomina_cargos')->where('id', $cargo_id);
                })->first();
            if (!empty($search_cargo)) {
                if (in_array($search_cargo->asignacion_cargo_id, $ids_asistencias)) {
                    $resumen_planillas = DB::table('planillas')
                        ->where([
                            ['nombre_planilla_id', '=', $nombre_planilla->id],
                            ['item', '=', $cargo->item],
                        ])->first();
                    $cargo->datos_planilla = $resumen_planillas;
                } else {
                    $cargo->datos_planilla = [];
                }
            } else {
                $cargo->datos_planilla = [];
            }
        }

        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');

        $total_secciones = [];
        $total_general = [];

        $sum_haber_basico = 0;
        $sum_bono_antiguedad = 0;
        $sum_extras = 0;
        $sum_suplencias = 0;
        $sum_sindicato = 0;
        $sum_total_ganado = 0;
        $sum_descuentos_afp = 0;
        $sum_prima_riesgo_comun = 0;
        $sum_comision_ente = 0;
        $sum_total_aporte_solidario = 0;
        $sum_descuentos_rciva = 0;
        $sum_descuento = 0;
        $sum_fondo_social = 0;
        $sum_fondo_empleados = 0;
        $sum_entidades_financieras = 0;
        $sum_total_descuentos = 0;
        $sum_liquido_pagable = 0;
        foreach ($cargos as $key => $cargo) {
            $sum_haber_basico_s = 0;
            $sum_bono_antiguedad_s = 0;
            $sum_extras_s = 0;
            $sum_suplencias_s = 0;
            $sum_sindicato_s = 0;
            $sum_total_ganado_s = 0;
            $sum_descuentos_afp_s = 0;
            $sum_prima_riesgo_comun_s = 0;
            $sum_comision_ente_s = 0;
            $sum_total_aporte_solidario_s = 0;
            $sum_descuentos_rciva_s = 0;
            $sum_descuento_s = 0;
            $sum_fondo_social_s = 0;
            $sum_fondo_empleados_s = 0;
            $sum_entidades_financieras_s = 0;
            $sum_total_descuentos_s = 0;
            $sum_liquido_pagable_s = 0;
            foreach ($cargo as $planilla) {
                if (!empty($planilla->datos_planilla)) {
                    $sum_haber_basico_s = $sum_haber_basico_s + $planilla->datos_planilla->haber_basico;
                    $sum_bono_antiguedad_s = $sum_bono_antiguedad_s + $planilla->datos_planilla->bono_antiguedad;
                    $sum_extras_s = $sum_extras_s + $planilla->datos_planilla->horas_extra;
                    $sum_suplencias_s = $sum_suplencias_s + $planilla->datos_planilla->suplencia;
                    $sum_total_ganado_s = $sum_total_ganado_s + $planilla->datos_planilla->total_ganado;
                    $sum_sindicato_s = $sum_sindicato_s + $planilla->datos_planilla->sindicato;
                    $sum_descuentos_afp_s = $sum_descuentos_afp_s + $planilla->datos_planilla->categoria_individual;
                    $sum_prima_riesgo_comun_s = $sum_prima_riesgo_comun_s + $planilla->datos_planilla->prima_riesgo_comun;
                    $sum_comision_ente_s = $sum_comision_ente_s + $planilla->datos_planilla->comision_ente;
                    $sum_total_aporte_solidario_s = $sum_total_aporte_solidario_s + $planilla->datos_planilla->total_aporte_solidario;
                    $sum_descuentos_rciva_s = $sum_descuentos_rciva_s + $planilla->datos_planilla->desc_rciva;
                    $sum_descuento_s = $sum_descuento_s + $planilla->datos_planilla->otros_descuentos;
                    $sum_fondo_social_s = $sum_fondo_social_s + $planilla->datos_planilla->fondo_social;
                    $sum_fondo_empleados_s = $sum_fondo_empleados_s + $planilla->datos_planilla->fondo_empleados;
                    $sum_entidades_financieras_s = $sum_entidades_financieras_s + $planilla->datos_planilla->entidades_financieras;
                    $sum_total_descuentos_s = $sum_total_descuentos_s + $planilla->datos_planilla->total_descuentos;
                    $sum_liquido_pagable_s = $sum_liquido_pagable_s + $planilla->datos_planilla->liquido_pagable;
                }
            }
            array_push($total_secciones, (object)[
                'seccion' => $key,
                'sum_haber_basico_s' => Funciones::formatMoney($sum_haber_basico_s),
                'sum_bono_antiguedad_s' => Funciones::formatMoney($sum_bono_antiguedad_s),
                'sum_extras_s' => Funciones::formatMoney($sum_extras_s),
                'sum_suplencias_s' => Funciones::formatMoney($sum_suplencias_s),
                'sum_sindicato_s' => Funciones::formatMoney($sum_sindicato_s),
                'sum_total_ganado_s' => Funciones::formatMoney($sum_total_ganado_s),
                'sum_descuentos_afp_s' => Funciones::formatMoney($sum_descuentos_afp_s),
                'sum_prima_riesgo_comun_s' => Funciones::formatMoney($sum_prima_riesgo_comun_s),
                'sum_comision_ente_s' => Funciones::formatMoney($sum_comision_ente_s),
                'sum_total_aporte_solidario_s' => Funciones::formatMoney($sum_total_aporte_solidario_s),
                'sum_descuentos_rciva_s' => Funciones::formatMoney($sum_descuentos_rciva_s),
                'sum_descuento_s' => Funciones::formatMoney($sum_descuento_s),
                'sum_fondo_social_s' => Funciones::formatMoney($sum_fondo_social_s),
                'sum_fondo_empleados_s' => Funciones::formatMoney($sum_fondo_empleados_s),
                'sum_entidades_financieras_s' => Funciones::formatMoney($sum_entidades_financieras_s),
                'sum_total_descuentos_s' => Funciones::formatMoney($sum_total_descuentos_s),
                'sum_liquido_pagable_s' => Funciones::formatMoney($sum_liquido_pagable_s)
            ]);

            $sum_haber_basico = $sum_haber_basico_s + $sum_haber_basico;
            $sum_bono_antiguedad = $sum_bono_antiguedad_s + $sum_bono_antiguedad;
            $sum_extras = $sum_extras_s + $sum_extras;
            $sum_suplencias = $sum_suplencias_s + $sum_suplencias;
            $sum_total_ganado = $sum_total_ganado_s + $sum_total_ganado;
            $sum_sindicato = $sum_sindicato_s + $sum_sindicato;
            $sum_descuentos_afp = $sum_descuentos_afp_s + $sum_descuentos_afp;
            $sum_prima_riesgo_comun = $sum_prima_riesgo_comun_s + $sum_prima_riesgo_comun;
            $sum_comision_ente = $sum_comision_ente_s + $sum_comision_ente;
            $sum_total_aporte_solidario = $sum_total_aporte_solidario_s + $sum_total_aporte_solidario;
            $sum_descuentos_rciva = $sum_descuentos_rciva_s + $sum_descuentos_rciva;
            $sum_descuento = $sum_descuento_s + $sum_descuento;
            $sum_fondo_social = $sum_fondo_social_s + $sum_fondo_social;
            $sum_fondo_empleados = $sum_fondo_empleados_s + $sum_fondo_empleados;
            $sum_entidades_financieras = $sum_entidades_financieras_s + $sum_entidades_financieras;
            $sum_total_descuentos = $sum_total_descuentos_s + $sum_total_descuentos;
            $sum_liquido_pagable = $sum_liquido_pagable_s + $sum_liquido_pagable;
        }
        array_push($total_general, (object)[
            'seccion' => 'TOTAL GENERAL',
            'sum_haber_basico' => Funciones::formatMoney($sum_haber_basico),
            'sum_bono_antiguedad' => Funciones::formatMoney($sum_bono_antiguedad),
            'sum_extras' => Funciones::formatMoney($sum_extras),
            'sum_suplencias' => Funciones::formatMoney($sum_suplencias),
            'sum_sindicato' => Funciones::formatMoney($sum_sindicato),
            'sum_total_ganado' => Funciones::formatMoney($sum_total_ganado),
            'sum_descuentos_afp' => Funciones::formatMoney($sum_descuentos_afp),
            'sum_prima_riesgo_comun' => Funciones::formatMoney($sum_prima_riesgo_comun),
            'sum_comision_ente' => Funciones::formatMoney($sum_comision_ente),
            'sum_total_aporte_solidario' => Funciones::formatMoney($sum_total_aporte_solidario),
            'sum_descuentos_rciva' => Funciones::formatMoney($sum_descuentos_rciva),
            'sum_descuento' => Funciones::formatMoney($sum_descuento),
            'sum_fondo_social' => Funciones::formatMoney($sum_fondo_social),
            'sum_fondo_empleados' => Funciones::formatMoney($sum_fondo_empleados),
            'sum_entidades_financieras' => Funciones::formatMoney($sum_entidades_financieras),
            'sum_total_descuentos' => Funciones::formatMoney($sum_total_descuentos),
            'sum_liquido_pagable' => Funciones::formatMoney($sum_liquido_pagable)
        ]);

        $total= [
            'total_secciones' => $total_secciones,
            'total_general' => $total_general,
        ];
        return $total;
    }

    public function nombre_planilla()
    {
        return $this->belongsTO(NombrePlanilla::class);
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}

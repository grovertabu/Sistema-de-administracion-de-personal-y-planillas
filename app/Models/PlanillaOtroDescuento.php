<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaOtroDescuento extends Model
{
    protected $table = 'planilla_otro_descuentos';

    public function otro_descuento_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_otro_descuento = static::select(
            'planilla_otro_descuentos.*',
            'planilla_total_ganados.haber_basico',
            'planilla_total_ganados.total_ganado',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_otro_descuentos.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('planilla_total_ganados', 'planilla_total_ganados.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_otro_descuentos.mes', '=', $mes],
                ['planilla_otro_descuentos.gestion', '=', $gestion],
                ['planilla_otro_descuentos.tipo_contrato', '=', $tipo_contrato],
                ['planilla_total_ganados.mes', '=', $mes],
                ['planilla_total_ganados.gestion', '=', $gestion],
                ['planilla_total_ganados.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_otro_descuento;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

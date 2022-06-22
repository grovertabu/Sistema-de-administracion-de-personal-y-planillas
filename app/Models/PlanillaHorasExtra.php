<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PlanillaHorasExtra extends Model
{
    protected $table = 'planilla_horas_extras';
    public function horas_extra_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_horas_extra = static::select(
            'planilla_horas_extras.id',
            'planilla_horas_extras.mes',
            'planilla_horas_extras.gestion',
            'planilla_horas_extras.tipo_contrato',
            'planilla_horas_extras.tipo_hora_extra',
            'planilla_horas_extras.factor_calculo',
            'planilla_horas_extras.cantidad',
            'planilla_horas_extras.monto',
            'planilla_horas_extras.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_horas_extras.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_horas_extras.mes', '=', $mes],
                ['planilla_horas_extras.gestion', '=', $gestion],
                ['planilla_horas_extras.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_horas_extra;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

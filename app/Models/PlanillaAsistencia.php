<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaAsistencia extends Model
{
    protected $table = 'planilla_asistencias';

    public function asistencia_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_asistencia = static::select(
            'planilla_asistencias.id',
            'planilla_asistencias.mes',
            'planilla_asistencias.gestion',
            'planilla_asistencias.tipo_contrato',
            'planilla_asistencias.dias_asistencia',
            'planilla_asistencias.dias_laborales',
            'planilla_asistencias.observacion',
            'planilla_asistencias.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_asistencias.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_asistencias.mes', '=', $mes],
                ['planilla_asistencias.gestion', '=', $gestion],
                ['planilla_asistencias.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_asistencia;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaImpositiva extends Model
{
    protected $table = 'planilla_impositivas';

    public function impositiva_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_impositiva = static::select(
            'planilla_impositivas.*',
            'planilla_refrigerios.total_refrigerio as total_refrigerio',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,'<br>',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_impositivas.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('planilla_refrigerios', 'planilla_refrigerios.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_impositivas.mes', '=', $mes],
                ['planilla_impositivas.gestion', '=', $gestion],
                ['planilla_impositivas.tipo_contrato', '=', $tipo_contrato],
                ['planilla_refrigerios.mes', '=', $mes],
                ['planilla_refrigerios.gestion', '=', $gestion],
                ['planilla_refrigerios.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_impositiva;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

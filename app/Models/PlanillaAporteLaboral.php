<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaAporteLaboral extends Model
{
    protected $table = 'planilla_aporte_laborals';

    public function aporte_laboral_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_aporte_laboral = static::select(
            'planilla_aporte_laborals.id',
            'planilla_aporte_laborals.mes',
            'planilla_aporte_laborals.gestion',
            'planilla_aporte_laborals.tipo_aporte',
            'planilla_aporte_laborals.porcentaje_aporte',
            'planilla_aporte_laborals.monto_aporte',
            'planilla_aporte_laborals.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_aporte_laborals.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_aporte_laborals.mes', '=', $mes],
                ['planilla_aporte_laborals.gestion', '=', $gestion],
                ['planilla_aporte_laborals.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_aporte_laboral;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

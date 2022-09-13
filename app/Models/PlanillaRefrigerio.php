<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaRefrigerio extends Model
{

    protected $table = 'planilla_refrigerios';

    const CONF_REFRIGERIO = [
        'descripcion' => 'REFRIGERIO PERSONAL DE PLANTA',
        'monto_refrigerio'=> 30.00
    ];

    public function refrigerio_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_refrigerio = static::select(
            'planilla_refrigerios.id',
            'planilla_refrigerios.mes',
            'planilla_refrigerios.gestion',
            'planilla_refrigerios.tipo_contrato',
            'planilla_refrigerios.dias_asistencia',
            'planilla_refrigerios.dias_laborales',
            'planilla_refrigerios.monto_refrigerio',
            'planilla_refrigerios.otros',
            'planilla_refrigerios.total_refrigerio',
            'planilla_refrigerios.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_refrigerios.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_refrigerios.mes', '=', $mes],
                ['planilla_refrigerios.gestion', '=', $gestion],
                ['planilla_refrigerios.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_refrigerio;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }

}

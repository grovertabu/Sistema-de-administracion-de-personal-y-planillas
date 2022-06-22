<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class PlanillaSuplencia extends Model
{
    protected $table = 'planilla_suplencias';
    public function suplencia_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_suplencia = static::select(
            'planilla_suplencias.id',
            'planilla_suplencias.mes',
            'planilla_suplencias.gestion',
            'planilla_suplencias.tipo_contrato',
            'planilla_suplencias.fecha_inicio',
            'planilla_suplencias.fecha_fin',
            'planilla_suplencias.total_dias',
            'planilla_suplencias.cargo_suplencia',
            'planilla_suplencias.salario_mensual',
            'planilla_suplencias.monto',
            'planilla_suplencias.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_suplencias.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_suplencias.mes', '=', $mes],
                ['planilla_suplencias.gestion', '=', $gestion],
                ['planilla_suplencias.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_suplencia;
    }

    protected $guarded = [];

    protected $casts = [
        'fecha_inicio' => 'date:d-m-Y',
        'fecha_fin' => 'date:d-m-Y',
    ];

    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}

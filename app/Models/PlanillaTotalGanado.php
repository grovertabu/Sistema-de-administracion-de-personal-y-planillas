<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaTotalGanado extends Model
{
    protected $table = 'planilla_total_ganados';

    public function total_ganado_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_total_ganado = static::select(
            'planilla_total_ganados.id',
            'planilla_total_ganados.mes',
            'planilla_total_ganados.gestion',
            'planilla_total_ganados.tipo_contrato',
            'planilla_total_ganados.total_dias',
            'planilla_total_ganados.haber_mensual',
            'planilla_total_ganados.haber_basico',
            'planilla_total_ganados.bono_antiguedad',
            'planilla_total_ganados.horas_extra',
            'planilla_total_ganados.monto_horas_extra',
            'planilla_total_ganados.suplencia',
            'planilla_total_ganados.total_ganado',
            'planilla_total_ganados.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_total_ganados.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_total_ganados.mes', '=', $mes],
                ['planilla_total_ganados.gestion', '=', $gestion],
                ['planilla_total_ganados.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_total_ganado;
    }

    public function registros_asistencia($conditions){
        return DB::table('asignacion_cargos as ac')
                ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
                ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
                ->join('planilla_asistencias as a', 'a.asignacion_cargo_id', 'ac.id')
                ->select(
                    'ac.id as asignacion_cargo_id',
                    'ac.fecha_ingreso as fecha_ingreso',
                    'ac.estado as estado_asignacion',
                    'es.salario_mensual as salario_mensual',
                    'a.mes as mes',
                    'a.gestion as gestion',
                    'a.tipo_contrato as tipo_contrato',
                    'a.dias_asistencia as dias_asistencia',
                    'a.dias_laborales as dias_laborales',
                )
                ->where($conditions)
                ->get();
    }
    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

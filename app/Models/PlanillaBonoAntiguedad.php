<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTimeInterface;

class PlanillaBonoAntiguedad extends Model
{
    protected $table = 'planilla_bono_antiguedads';
    public function bono_antiguedad_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_bono_antiguedads = static::select(
            'planilla_bono_antiguedads.id',
            'planilla_bono_antiguedads.mes',
            'planilla_bono_antiguedads.gestion',
            'planilla_bono_antiguedads.tipo_contrato',
            'planilla_bono_antiguedads.anios_arrastre',
            'planilla_bono_antiguedads.meses_arrastre',
            'planilla_bono_antiguedads.dias_arrastre',
            'planilla_bono_antiguedads.fecha_ingreso',
            'planilla_bono_antiguedads.fecha_calculo',
            'planilla_bono_antiguedads.anios_actual',
            'planilla_bono_antiguedads.meses_actual',
            'planilla_bono_antiguedads.dias_actual',
            'planilla_bono_antiguedads.porcentaje',
            'planilla_bono_antiguedads.monto',
            'planilla_bono_antiguedads.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_bono_antiguedads.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_bono_antiguedads.mes', '=', $mes],
                ['planilla_bono_antiguedads.gestion', '=', $gestion],
                ['planilla_bono_antiguedads.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_bono_antiguedads;
    }

    protected $guarded = [];

    protected $casts = [
        'fecha_ingreso' => 'date:d-m-Y',
        'fecha_calculo' => 'date:d-m-Y',
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

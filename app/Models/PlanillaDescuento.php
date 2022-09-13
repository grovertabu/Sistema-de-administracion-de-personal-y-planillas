<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanillaDescuento extends Model
{
    protected $table = 'planilla_descuentos';

    public function descuento_lista($mes, $gestion, $tipo_contrato)
    {
        $lista_descuento = static::select(
            'planilla_descuentos.id',
            'planilla_descuentos.mes',
            'planilla_descuentos.gestion',
            'planilla_descuentos.nombre_descuento',
            'planilla_descuentos.monto',
            'planilla_descuentos.asignacion_cargo_id',
            'nomina_cargos.item',
            'cargos.nombre as nombre_cargo',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo")
        )
            ->join('asignacion_cargos', 'planilla_descuentos.asignacion_cargo_id', 'asignacion_cargos.id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where([
                ['planilla_descuentos.mes', '=', $mes],
                ['planilla_descuentos.gestion', '=', $gestion],
                ['planilla_descuentos.tipo_contrato', '=', $tipo_contrato]
            ])
            ->orderBy('nomina_cargos.item')
            ->get();
        return $lista_descuento;
    }

    protected $guarded = [];
    public function asignacion_cargo()
    {
        return $this->belongsTO(AsignacionCargo::class);
    }
}

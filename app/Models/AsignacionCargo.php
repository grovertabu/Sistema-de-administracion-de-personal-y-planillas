<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class AsignacionCargo extends Model
{
    protected $table = 'asignacion_cargos';

    protected $fillable = [
        'id',
        'fecha_ingreso',
        'fecha_nuevo_cargo',
        'fecha_conclusion',
        'observacion',
        'motivo_baja',
        'aporte_afp',
        'sindicato',
        'socio_fe',
        'trabajador_id',
        'nomina_cargo_id',
        'estado',
    ];
    protected $casts = [
        'fecha_ingreso' => 'date:d-m-Y',
        'fecha_nuevo_cargo' => 'date:d-m-Y',
        'fecha_conclusion' => 'date:d-m-Y',
    ];

    public function getData($tipo_contrato_id){
        $asignacion_cargo = static::select('asignacion_cargos.id',
            'asignacion_cargos.fecha_ingreso',
            'asignacion_cargos.fecha_nuevo_cargo',
            'asignacion_cargos.fecha_conclusion',
            'asignacion_cargos.aporte_afp',
            'asignacion_cargos.sindicato',
            'asignacion_cargos.socio_fe',
            'asignacion_cargos.trabajador_id',
            'asignacion_cargos.nomina_cargo_id',
            'asignacion_cargos.estado',
            'nc.item as item',
            )
            ->join('nomina_cargos as nc','nc.id','asignacion_cargos.nomina_cargo_id')
            ->with(['trabajador' => function($query){
                $query->select('id','ci','nombre','apellido_paterno','apellido_materno');
            }])
            ->with(['nomina_cargo' => function($query){
                $query->select('id','item','cargo_id','escala_salarial_id');
            },
            'nomina_cargo.cargo'=>function($query){
                $query->select('id','nombre');
            },
            'nomina_cargo.escala_salarial'=>function($query){
                $query->select('id','salario_mensual');
            },
            ])
            ->whereHas('nomina_cargo', function ($query) use ($tipo_contrato_id) {
                $query->where('tipo_contrato_id', '=', $tipo_contrato_id);
            })->orderBy('nc.item','asc');
        return $asignacion_cargo;
    }

    public function nomina_cargo()
    {
        return $this->belongsTO(NominaCargo::class);
    }

    public function trabajador()
    {
        return $this->belongsTO(Trabajador::class);
    }

    public function planilla_asistencias()
    {
        return $this->hasMany(PlanillaAsistencia::class);
    }

    public function planilla_bono_antiguedads()
    {
        return $this->hasMany(PlanillaBonoAntiguedad::class);
    }

    public function planilla_horas_extras()
    {
        return $this->hasMany(PlanillaHorasExtra::class);
    }

    public function planilla_suplencias()
    {
        return $this->hasMany(PlanillaSuplencia::class);
    }

    public function planilla_total_ganados()
    {
        return $this->hasMany(PlanillaTotalGanado::class);
    }

    public function planilla_aporte_laborals()
    {
        return $this->hasMany(PlanillaAporteLaboral::class);
    }

    public function planilla_impositivas()
    {
        return $this->hasMany(PlanillaImpositiva::class);
    }

    public function planilla_otro_descuentos()
    {
        return $this->hasMany(PlanillaOtroDescuento::class);
    }

    public function planilla_descuentos()
    {
        return $this->hasMany(PlanillaDescuento::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}

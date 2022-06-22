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
        'fecha_conclusion',
        'observacion',
        'aporte_afp',
        'sindicato',
        'socio_fe',
        'trabajador_id',
        'nomina_cargo_id',
        'estado',
    ];
    protected $casts = [
        'fecha_ingreso' => 'date:d-m-Y',
        'fecha_conclusion' => 'date:d-m-Y',
    ];

    public function getData($tipo_contrato_id){
        $asignacion_cargo = static::select('id',
            'fecha_ingreso',
            'fecha_conclusion',
            'aporte_afp',
            'sindicato',
            'socio_fe',
            'trabajador_id',
            'nomina_cargo_id',
            'estado')
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
            })->orderBy('estado','asc');
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}

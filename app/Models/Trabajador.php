<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Trabajador extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci',
        'expedido',
        'nro_asegurado',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'direccion',
        'tipo_sangre',
        'celular',
        'telefono',
        'profesion',
        'estado_civil',
        'sexo',
        'nacionalidad',
        'fecha_nacimiento',
        'antiguedad_anios',
        'antiguedad_meses',
        'antiguedad_dias',
        'foto',
        'estado_trabajador'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date:d-m-Y',
    ];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    public function formacion_academicas()
    {
        return $this->hasMany('App\Models\Formacion_academica');
    }
    public function documentos_personales()
    {
        return $this->hasMany('App\Models\DocumentoPersonal');
    }
    public function cursos()
    {
        return $this->hasMany('App\Models\Curso');
    }
    public function exp_laborals()
    {
        return $this->hasMany('App\Models\Experiencia_laboral');
    }
    public function meritos()
    {
        return $this->hasMany('App\Models\Merito');
    }
    public function demeritos()
    {
        return $this->hasMany('App\Models\Demerito');
    }
    public function asignacion_cargo()
    {
        return $this->hasMany(AsignacionCargo::class);
    }
}

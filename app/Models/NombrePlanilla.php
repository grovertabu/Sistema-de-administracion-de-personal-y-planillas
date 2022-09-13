<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class NombrePlanilla extends Model
{
    protected $table = 'nombre_planillas';

    protected $fillable = [
        'id',
        'mes',
        'gestion',
        'tipo_contrato',
        'nombre_planilla',
        'fecha_creacion',
        'estado',
    ];
    protected $casts = [
        'fecha_creacion' => 'date:d-m-Y',
    ];


    public function planillas()
    {
        return $this->hasMany(Planilla::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}

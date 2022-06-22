<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaCargo extends Model
{

    protected $table = 'nomina_cargos';

    protected $fillable = [
        'id',
        'item',
        'unidad_organizacional_id',
        'cargo_id',
        'escala_salarial_id',
        'tipo_contrato_id',
        'estado',
    ];

    public function tipo_contrato()
    {
        return $this->belongsTO(Tipo_Contrato::class,'tipo_contrato_id');
    }

    public function unidad_organizacional()
    {
        return $this->belongsTO(Unidad_organizacional::class);
    }

    public function cargo()
    {
        return $this->belongsTO(Cargo::class);
    }

    public function escala_salarial()
    {
        return $this->belongsTO(Escala_salarial::class);
    }

    public function asignacion_cargo()
    {
        return $this->hasMany(AsignacionCargo::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad_organizacional extends Model
{
    protected $fillable = [
        'id',
        'seccion',
        'estado',
        'estructura_organizacional_id'
    ];

    public function estructura_organizacional()
    {
        return $this->belongsTO(Estructura_Organizacional::class);
    }

    public function nomina_cargos()
    {
        return $this->hasMany(NominaCargo::class);
    }
}

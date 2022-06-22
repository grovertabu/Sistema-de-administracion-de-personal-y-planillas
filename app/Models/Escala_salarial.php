<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala_salarial extends Model
{
    use HasFactory;

    protected $table = 'escala_salarials';

    protected $fillable = [
        'id',
        'nivel',
        'descripcion',
        'casos',
        'salario_mensual',
        'estado',
        'estructura_organizacional_id'
    ];

    protected $casts = [
        'salario_mensual' => 'float',
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

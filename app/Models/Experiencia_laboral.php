<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia_laboral extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre_entidad',
        'cargo_laboral',
        'funcion_laboral',
        'fecha_inicio',
        'fecha_fin',
        'file_exp_laboral',
        'created_by',
        'updated_by',
        'trabajador_id',
    ];
    public function trabajador()
    {
        return $this->belongsTO('App\Models\Trabajador');
    }

}

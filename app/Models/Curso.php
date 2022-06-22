<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre_curso',
        'institucion',
        'horas_academicas',
        'fecha_curso',
        'file_curso',
        'created_by',
        'updated_by',
        'trabajador_id',
    ];
    public function trabajador()
    {
        return $this->belongsTO('App\Models\Trabajador');
    }
}

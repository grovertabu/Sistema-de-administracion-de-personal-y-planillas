<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacion_academica extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nivel_formacion',
        'institucion',
        'titulo_formacion',
        'lugar_formacion',
        'fecha_emision',
        'trabajador_id',
        'file_formacion',
    ];

    protected $casts = [
        'fecha_emision' => 'date:d/m/Y',
    ];

    public function trabajador()
    {
        return $this->belongsTO('App\Models\Trabajador');
    }

}

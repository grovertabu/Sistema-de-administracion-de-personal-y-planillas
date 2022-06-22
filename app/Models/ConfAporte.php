<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfAporte extends Model
{
    use HasFactory;
    protected $table = 'conf_aportes';

    protected $fillable = [
        'tipo_aporte',
        'rango_inicial',
        'rango_final',
        'porcentaje_aporte',
        'estado',
    ];
}

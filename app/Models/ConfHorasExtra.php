<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfHorasExtra extends Model
{
    protected $table = 'conf_horas_extras';

    protected $fillable = [
        'tipo_hora_extra',
        'factor_calculado',
        'estado',
    ];
}

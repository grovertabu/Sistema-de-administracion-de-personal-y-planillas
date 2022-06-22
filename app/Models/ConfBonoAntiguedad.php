<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfBonoAntiguedad extends Model
{
    use HasFactory;
    protected $table = 'conf_bono_antiguedads';

    protected $fillable = [
        'anio_i',
        'anio_f',
        'porcentaje',
        'estado',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfImpositiva extends Model
{
    use HasFactory;
    protected $table = 'conf_impositivas';

    protected $fillable = [
        'salario_minimo',
        'cantidad_salario_minimo',
        'porcentaje_impositiva',
        'estado',
    ];
}

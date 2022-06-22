<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfOtroDescuento extends Model
{
    use HasFactory;
    protected $table = 'conf_otro_descuentos';

    protected $fillable = [
        'descripcion',
        'factor_calculado',
        'estado',
    ];
}

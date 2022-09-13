<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfDescuento extends Model
{
    protected $table = 'conf_descuentos';

    protected $fillable = [
        'nombre_descuento',
        'estado',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estructura_Organizacional extends Model
{
    use HasFactory;

    protected $table = 'estructura_organizacionals';

    protected $fillable = [
        'id',
        'nombre',
        'version',
        'estado'
    ];
    public function escalas_salariales()
    {
        return $this->hasMany(Escala_salarial::class,'estructura_organizacional_id');
    }
    public function unidades_organizacionales()
    {
        return $this->hasMany(Unidad_organizacional::class,'estructura_organizacional_id');
    }
    public function cargos()
    {
        return $this->hasMany(Cargo::class,'estructura_organizacional_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';

    protected $fillable = [
        'id',
        'nombre',
        'estado',
        'estructura_organizacional_id',
    ];

    public function estructura_organizacional()
    {
        return $this->belongsTO(Estructura_Organizacional::class);
    }

    public function nomina_cargos()
    {
        return $this->hasMany(NominaCargo::class);
    }

}

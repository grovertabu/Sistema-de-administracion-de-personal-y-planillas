<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Contrato extends Model
{
    protected $table = 'tipo_contratos';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function nomina_cargos()
    {
        return $this->hasMany(NominaCargo::class,'tipo_contrato_id');
    }


}

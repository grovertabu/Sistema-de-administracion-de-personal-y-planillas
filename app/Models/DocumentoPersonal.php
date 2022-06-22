<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class DocumentoPersonal extends Model
{
    use HasFactory;

    protected $table = 'documento_personals';

    public $timestamps = false;

    protected $fillable = [
        'detalle_documento',
        'tipo_documento',
        'fecha_registro',
        'file_documento',
        'created_by',
        'updated_by',
        'trabajador_id',
    ];
    protected $casts = [
        'fecha_registro' => 'date:d/m/Y',
    ];
    public function trabajador()
    {
        return $this->belongsTO('App\Models\Trabajador');
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    // public function getDateRegisterAttribute(){
    //     return $this->fecha_registro->format('d/m/Y');
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Merito extends Model
{
    use HasFactory;
    protected $table = 'meritos';

    public $timestamps = false;

    protected $fillable = [
        'detalle_merito',
        'fecha_merito',
        'file_merito',
        'created_by',
        'updated_by',
        'trabajador_id',
    ];
    protected $casts = [
        'fecha_merito' => 'date:d/m/Y',
    ];
    public function trabajador()
    {
        return $this->belongsTO('App\Models\Trabajador');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Demerito extends Model
{
    use HasFactory;
    protected $table = 'demeritos';

    public $timestamps = false;

    protected $fillable = [
        'detalle_demerito',
        'fecha_demerito',
        'file_demerito',
        'created_by',
        'updated_by',
        'trabajador_id',
    ];
    protected $casts = [
        'fecha_demerito' => 'date:d/m/Y',
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

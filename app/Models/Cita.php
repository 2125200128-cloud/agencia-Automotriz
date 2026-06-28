<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'nombre',
        'telefono',
        'fecha',
        'hora',
        'licencia',
        'vehiculo_nombre',
        'licencia_status',
    ];
}

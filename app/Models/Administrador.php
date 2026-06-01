<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';

    public $timestamps = false;

    protected $fillable = [
        'nombres', 'apellidos', 'correo', 'usuario', 'contrasena', 'imagen',
    ];

    protected $hidden = [
        'contrasena',
    ];

    protected function casts(): array
    {
        return [
            'contrasena' => 'hashed',
        ];
    }
}

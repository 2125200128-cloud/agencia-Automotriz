<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'clientes';

    public $timestamps = false;

    protected $fillable = [
        'nombres', 'apellidos', 'correo', 'contrasena', 'direccion', 'imagen',
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

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'cliente_id');
    }
}

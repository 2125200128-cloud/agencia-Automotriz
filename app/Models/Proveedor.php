<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'contacto',
        'telefono',
        'correo',
        'direccion',
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}

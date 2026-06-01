<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cliente_id', 'fecha', 'descuento',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'productos_pedido', 'pedido_id', 'producto_id')
            ->using(ProductoPedido::class)
            ->withPivot(['cantidad', 'precio', 'descuento']);
    }

    public function productosPedido(): HasMany
    {
        return $this->hasMany(ProductoPedido::class, 'pedido_id');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'pedido_id');
    }
}

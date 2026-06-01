<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    public $timestamps = false;

    protected $fillable = [
        'cliente_id', 'fecha', 'descuento', 'iva', 'total', 'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'descuento' => 'decimal:2',
            'iva' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

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

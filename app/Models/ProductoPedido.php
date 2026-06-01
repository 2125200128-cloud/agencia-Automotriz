<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductoPedido extends Pivot
{
    protected $table = 'productos_pedido';

    public $timestamps = false;

    public $incrementing = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio',
        'descuento',
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

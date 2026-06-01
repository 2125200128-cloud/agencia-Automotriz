<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductoPedido extends Pivot
{
    use HasFactory;

    protected $table = 'pedido_producto';

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

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'descuento' => 'decimal:2',
        ];
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

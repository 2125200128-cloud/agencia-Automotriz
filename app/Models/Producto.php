<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion', 'numero_serie', 'anio', 'detalles', 'precio',
        'marca_id', 'modelo_id', 'tipo_id', 'color_id', 'proveedor_id',
        'existencia', 'descuento', 'imagen_uno', 'imagen_dos', 'imagen_tres', 'estado',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'descuento' => 'decimal:2',
        ];
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function modelo(): BelongsTo
    {
        return $this->belongsTo(ModeloVehiculo::class, 'modelo_id');
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function pedidos(): BelongsToMany
    {
        return $this->belongsToMany(Pedido::class, 'productos_pedido', 'producto_id', 'pedido_id')
            ->using(ProductoPedido::class)
            ->withPivot(['cantidad', 'precio', 'descuento']);
    }
}

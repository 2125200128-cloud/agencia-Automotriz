<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModeloVehiculo extends Model
{
    protected $table = 'modelos';

    public $timestamps = false;

    protected $fillable = [
        'marca_id',
        'nombre',
        'imagen',
    ];

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'modelo_id');
    }
}

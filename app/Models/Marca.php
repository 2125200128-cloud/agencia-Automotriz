<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'imagen',
    ];

    public function modelos(): HasMany
    {
        return $this->hasMany(ModeloVehiculo::class, 'marca_id');
    }

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }
}

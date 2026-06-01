<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'imagen',
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'tipo_id');
    }
}

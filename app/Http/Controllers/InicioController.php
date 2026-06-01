<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Tipo;

class InicioController extends Controller
{
    public function inicio()
    {
        return view('inicio', [
            'categorias' => Tipo::query()->withCount('productos')->orderBy('nombre')->get(),
            'marcas' => Marca::query()->orderBy('nombre')->get(),
            'vehiculos' => Producto::query()
                ->with(['marca', 'tipo'])
                ->where('estado', 'activo')
                ->orderByDesc('id')
                ->limit(3)
                ->get(),
            'totalVehiculos' => Producto::query()->count(),
        ]);
    }
}

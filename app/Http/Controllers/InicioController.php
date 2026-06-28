<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Tipo;

class InicioController extends Controller
{
    public function publico()
    {
        return view('index', [
            'vehiculos' => Producto::query()
                ->with(['marca', 'modelo', 'tipo', 'color'])
                ->where('estado', 'activo')
                ->orderByDesc('id')
                ->get()
                ->unique(fn ($producto) => $producto->numero_serie ?: mb_strtolower($producto->nombre))
                ->values(),
            'marcas' => Marca::query()->orderBy('nombre')->get(),
            'categorias' => Tipo::query()->withCount('productos')->orderBy('nombre')->get(),
        ]);
    }

    public function inicio()
    {
        return view('inicio', [
            'categorias' => Tipo::query()->withCount('productos')->orderBy('nombre')->get(),
            'marcas' => Marca::query()->orderBy('nombre')->get(),
            'vehiculos' => Producto::query()
                ->with(['marca', 'tipo'])
                ->where('estado', 'activo')
                ->orderByDesc('id')
                ->get()
                ->unique(fn ($producto) => $producto->numero_serie ?: mb_strtolower($producto->nombre))
                ->take(3)
                ->values(),
            'totalVehiculos' => Producto::query()->count(),
        ]);
    }
}

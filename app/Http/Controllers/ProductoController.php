<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Productos',
            'descripcion' => 'Inventario de vehiculos registrados.',
            'registros' => Producto::query()
                ->with(['marca', 'modelo', 'tipo', 'color', 'proveedor'])
                ->orderBy('nombre')
                ->get(),
            'columnas' => [
                'id' => 'ID',
                'nombre' => 'Vehiculo',
                'marca.nombre' => 'Marca',
                'modelo.nombre' => 'Modelo',
                'tipo.nombre' => 'Tipo',
                'color.nombre' => 'Color',
                'proveedor.nombre' => 'Proveedor',
                'precio' => 'Precio',
                'existencia' => 'Existencia',
                'estado' => 'Estado',
            ],
            'urlFormulario' => '/producto/formulario',
        ]);
    }

    public function formulario()
    {
        return view('productoauto.formulario');
    }
}

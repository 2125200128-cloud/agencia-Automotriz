<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Color;
use App\Models\Marca;
use App\Models\ModeloVehiculo;
use App\Models\Proveedor;
use App\Models\Tipo;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listado()
    {
        $titulo = 'Productos';
        $descripcion = 'Inventario de vehiculos registrados.';
        $registros = Producto::with(['marca', 'modelo', 'tipo', 'color', 'proveedor'])->get();
        $columnas = [
            'id' => 'ID',
            'nombre' => 'Vehiculo',
            'numero_serie' => 'Numero de serie',
            'marca.nombre' => 'Marca',
            'modelo.nombre' => 'Modelo',
            'tipo.nombre' => 'Tipo',
            'color.nombre' => 'Color',
            'proveedor.nombre' => 'Proveedor',
            'precio' => 'Precio',
            'existencia' => 'Existencia',
            'imagen_principal' => 'Imagen principal',
            'imagen_secundaria' => 'Imagen 2',
            'imagen_adicional' => 'Imagen 3',
            'estado' => 'Estado',
        ];
        $urlFormulario = '/producto/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        $marcas = Marca::all();
        $modelos = ModeloVehiculo::all();
        $tipos = Tipo::all();
        $colores = Color::all();
        $proveedores = Proveedor::all();

        return view('productoauto.formulario', compact('marcas', 'modelos', 'tipos', 'colores', 'proveedores'));
    }

    public function guardar(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->numero_serie = $request->input('numero_serie');
        $producto->anio = $request->input('anio');
        $producto->detalles = $request->input('detalles');
        $producto->precio = $request->input('precio');
        $producto->marca_id = $request->input('marca_id');
        $producto->modelo_id = $request->input('modelo_id');
        $producto->tipo_id = $request->input('tipo_id');
        $producto->color_id = $request->input('color_id');
        $producto->proveedor_id = $request->input('proveedor_id');
        $producto->existencia = $request->input('existencia');
        $producto->estado = $request->input('estado');

        foreach (['imagen_principal', 'imagen_secundaria', 'imagen_adicional'] as $imagen) {
            if ($request->hasFile($imagen)) {
                $producto->{$imagen} = $request->file($imagen)->store('productos', 'public');
            }
        }

        $producto->save();

        return redirect('/producto')->with('success', 'Producto guardado exitosamente.');
    }
}

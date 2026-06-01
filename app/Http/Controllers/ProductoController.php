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
            ],
            'urlFormulario' => '/producto/formulario',
        ]);
    }

    public function inicio()
    {
        return view('productoauto.formulario', [
            'marcas' => Marca::query()->orderBy('nombre')->get(),
            'modelos' => ModeloVehiculo::query()->orderBy('nombre')->get(),
            'tipos' => Tipo::query()->orderBy('nombre')->get(),
            'colores' => Color::query()->orderBy('nombre')->get(),
            'proveedores' => Proveedor::query()->orderBy('nombre')->get(),
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'numero_serie' => ['nullable', 'string', 'max:255', 'unique:productos,numero_serie'],
            'anio' => ['nullable', 'integer', 'min:1950', 'max:'.(date('Y') + 1)],
            'detalles' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'marca_id' => ['nullable', 'exists:marcas,id'],
            'modelo_id' => ['nullable', 'exists:modelos_vehiculos,id'],
            'tipo_id' => ['nullable', 'exists:tipos,id'],
            'color_id' => ['nullable', 'exists:colores,id'],
            'proveedor_id' => ['nullable', 'exists:proveedores,id'],
            'existencia' => ['required', 'integer', 'min:0'],
            'estado' => ['required', 'in:activo,inactivo'],
            'imagen_principal' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
            'imagen_secundaria' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
            'imagen_adicional' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

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

        return redirect('/producto');
    }
}

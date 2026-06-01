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
                'imagen_principal' => 'Imagen',
                'estado' => 'Estado',
            ],
            'urlFormulario' => '/producto/formulario',
        ]);
    }

    public function formulario()
    {
        return view('productoauto.formulario', [
            'marcas' => Marca::query()->orderBy('nombre')->get(),
            'modelos' => ModeloVehiculo::query()->orderBy('nombre')->get(),
            'tipos' => Tipo::query()->orderBy('nombre')->get(),
            'colores' => Color::query()->orderBy('nombre')->get(),
            'proveedores' => Proveedor::query()->orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'numero_serie' => ['nullable', 'string', 'max:255'],
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

        foreach (['imagen_principal', 'imagen_secundaria', 'imagen_adicional'] as $imagen) {
            if ($request->hasFile($imagen)) {
                $datos[$imagen] = $request->file($imagen)->store('productos', 'public');
            }
        }

        Producto::create($datos);

        return redirect('/producto');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Marca;
use App\Models\ModeloVehiculo;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function listado()
    {
        $productos = Producto::with(['marca', 'modelo', 'tipo', 'color', 'proveedor'])->get();

        return view('productos.inicio', compact('productos'));
    }

    public function inicio()
    {
        $marcas = Marca::all();
        $modelos = ModeloVehiculo::all();
        $tipos = Tipo::all();
        $colores = Color::all();
        $proveedores = Proveedor::all();

        return view('productos.formulario', compact('marcas', 'modelos', 'tipos', 'colores', 'proveedores'));
    }

    public function guardar(Request $request)
    {
        $producto = new Producto;
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
        $producto->existencia = $request->input('existencia', 0);
        $producto->descuento = $request->input('descuento', 0);
        $producto->estado = $request->input('estado', 'activo');

        foreach (['imagen_principal', 'imagen_secundaria', 'imagen_adicional'] as $imagen) {
            if ($request->hasFile($imagen)) {
                $producto->{$imagen} = $request->file($imagen)->store('productos', 'public');
            }
        }

        $producto->save();

        return redirect('/producto')->with('success', 'Producto guardado exitosamente.');
    }

    public function ver($id)
    {
        $producto = Producto::with(['marca', 'modelo', 'tipo', 'color', 'proveedor'])->find($id);

        if (! $producto) {
            abort(404);
        }

        return view('productos.ver', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::find($id);

        if (! $producto) {
            abort(404);
        }

        $marcas = Marca::all();
        $modelos = ModeloVehiculo::all();
        $tipos = Tipo::all();
        $colores = Color::all();
        $proveedores = Proveedor::all();

        return view('productos.editar', compact('producto', 'marcas', 'modelos', 'tipos', 'colores', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (! $producto) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'numero_serie' => ['nullable', 'string', 'max:255'],
            'anio' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'detalles' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'marca_id' => ['nullable', 'exists:marcas,id'],
            'modelo_id' => ['nullable', 'exists:modelos_vehiculos,id'],
            'tipo_id' => ['nullable', 'exists:tipos,id'],
            'color_id' => ['nullable', 'exists:colores,id'],
            'proveedor_id' => ['nullable', 'exists:proveedores,id'],
            'existencia' => ['required', 'integer', 'min:0'],
            'descuento' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'imagen_principal' => ['nullable', 'image', 'max:2048'],
            'imagen_secundaria' => ['nullable', 'image', 'max:2048'],
            'imagen_adicional' => ['nullable', 'image', 'max:2048'],
            'estado' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $producto->descuento = $request->input('descuento', 0);
        $producto->estado = $request->input('estado');

        foreach (['imagen_principal', 'imagen_secundaria', 'imagen_adicional'] as $imagen) {
            if ($request->hasFile($imagen)) {
                $producto->{$imagen} = $request->file($imagen)->store('productos', 'public');
            }
        }

        $producto->save();

        return redirect('/producto')->with('success', 'Producto actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $producto = Producto::with(['marca', 'modelo', 'tipo', 'color', 'proveedor'])->find($id);

        if (! $producto) {
            abort(404);
        }

        return view('productos.eliminar', compact('producto'));
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (! $producto) {
            abort(404);
        }

        $producto->delete();

        return redirect('/producto')->with('success', 'Producto eliminado exitosamente.');
    }
}

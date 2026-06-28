<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Support\PublicImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function listado()
    {
        $proveedores = Proveedor::all();

        return view('proveedores.inicio', compact('proveedores'));
    }

    public function inicio()
    {
        return view('proveedores.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['required', 'image', 'max:2048'],
            'estado' => ['nullable', Rule::in(['activo', 'inactivo'])],
        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->input('nombre', $request->input('nombre_empresa'));
        $proveedor->contacto = $request->input('contacto', $request->input('nombre_representante'));
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo', $request->input('email'));
        $proveedor->direccion = $request->input('direccion');
        $proveedor->estado = $request->input('estado', 'activo');
        $proveedor->save();

        if ($request->hasFile('imagen')) {
            $proveedor->imagen = $this->guardarImagen($request, $proveedor->id);
            $proveedor->save();
        }

        return redirect('/proveedor')->with('success', 'Proveedor guardado exitosamente.');
    }

    public function ver($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            abort(404);
        }

        return view('proveedores.ver', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            abort(404);
        }

        return view('proveedores.editar', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'contacto' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:255'],
            'correo' => ['nullable', 'email', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $proveedor->nombre = $request->input('nombre');
        $proveedor->contacto = $request->input('contacto');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->estado = $request->input('estado');

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $proveedor->imagen;
            $proveedor->imagen = $this->guardarImagen($request, $proveedor->id);
            $this->borrarImagen($imagenAnterior, $proveedor->imagen);
        }

        $proveedor->save();

        return redirect('/proveedor')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            abort(404);
        }

        return view('proveedores.eliminar', compact('proveedor'));
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            abort(404);
        }

        $imagen = $proveedor->imagen;
        $proveedor->delete();
        $this->borrarImagen($imagen);

        return redirect('/proveedor')->with('success', 'Proveedor eliminado exitosamente.');
    }

    private function guardarImagen(Request $request, int $id): string
    {
        $archivo = $request->file('imagen');
        $nombre = 'proveedor_' . $id . '.' . $archivo->getClientOriginalExtension();

        return PublicImage::storeAsUrl($archivo, 'proveedores', $nombre);
    }

    private function borrarImagen(?string $anterior, ?string $nueva = null): void
    {
        if ($anterior && $anterior !== $nueva) {
            PublicImage::delete($anterior);
        }
    }
}

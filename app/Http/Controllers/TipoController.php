<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TipoController extends Controller
{
    public function listado()
    {
        $titulo = 'Tipos';
        $descripcion = 'Tipos de vehiculo registrados.';
        $registros = Tipo::all();
        $columnas = [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
        $urlFormulario = '/tipos/formulario';
        $urlBase = '/tipos';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario', 'urlBase'));
    }

    public function inicio()
    {
        return view('tipos.formulario');
    }

    public function guardar(Request $request)
    {
        $tipo = new Tipo;
        $tipo->nombre = $request->input('nombre');

        $tipo->save();

        if ($request->hasFile('imagen')) {
            if ($tipo->imagen && Storage::disk('public')->exists($tipo->imagen)) {
                Storage::disk('public')->delete($tipo->imagen);
            }

            $file = $request->file('imagen');
            $nombre = 'tipo_' . $tipo->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('tipos', $nombre, 'public');
            $tipo->imagen = $ruta;
        }

        $tipo->save();

        return redirect('/tipos')->with('success', 'Tipo guardado exitosamente.');
    }

    public function ver($id)
    {
        $tipo = Tipo::find($id);

        if (! $tipo) {
            abort(404);
        }

        return view('tipos.ver', compact('tipo'));
    }

    public function edit($id)
    {
        $tipo = Tipo::find($id);

        if (! $tipo) {
            abort(404);
        }

        return view('tipos.editar', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::find($id);

        if (! $tipo) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tipo->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $tipo->imagen;
            $file = $request->file('imagen');
            $nombre = 'tipo_' . $tipo->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('tipos', $nombre, 'public');
            $tipo->imagen = $ruta;

            if ($imagenAnterior && $imagenAnterior !== $ruta && Storage::disk('public')->exists($imagenAnterior)) {
                Storage::disk('public')->delete($imagenAnterior);
            }
        }

        $tipo->save();

        return redirect('/tipos')->with('success', 'Tipo actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $tipo = Tipo::find($id);

        if (! $tipo) {
            abort(404);
        }

        return view('tipos.eliminar', compact('tipo'));
    }

    public function destroy($id)
    {
        $tipo = Tipo::find($id);

        if (! $tipo) {
            abort(404);
        }

        $imagen = $tipo->imagen;

        try {
            $tipo->productos()->update(['tipo_id' => null]);
            $tipo->delete();
        } catch (\Throwable $e) {
            return redirect('/tipos')->with('error', 'No se pudo eliminar el tipo porque tiene registros relacionados.');
        }

        if ($imagen && Storage::disk('public')->exists($imagen)) {
            Storage::disk('public')->delete($imagen);
        }

        return redirect('/tipos')->with('success', 'Tipo eliminado exitosamente.');
    }
}

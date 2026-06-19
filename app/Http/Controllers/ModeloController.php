<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\ModeloVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ModeloController extends Controller
{
    public function listado()
    {
        $modelos = ModeloVehiculo::with('marca')->get();

        return view('modelos.inicio', compact('modelos'));
    }

    public function inicio()
    {
        $marcas = Marca::all();

        return view('modelos.formulario', compact('marcas'));
    }

    public function guardar(Request $request)
    {
        $modelo = new ModeloVehiculo;
        $modelo->marca_id = $request->input('marca_id');
        $modelo->nombre = $request->input('nombre');

        $modelo->save();

        if ($request->hasFile('imagen')) {
            if ($modelo->imagen && Storage::disk('public')->exists($modelo->imagen)) {
                Storage::disk('public')->delete($modelo->imagen);
            }

            $file = $request->file('imagen');
            $nombre = 'modelo_' . $modelo->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('modelos', $nombre, 'public');
            $modelo->imagen = $ruta;
        }

        $modelo->save();

        return redirect('/modelos')->with('success', 'Modelo guardado exitosamente.');
    }

    public function ver($id)
    {
        $modelo = ModeloVehiculo::with('marca')->find($id);

        if (! $modelo) {
            abort(404);
        }

        return view('modelos.ver', compact('modelo'));
    }

    public function edit($id)
    {
        $modelo = ModeloVehiculo::find($id);

        if (! $modelo) {
            abort(404);
        }

        $marcas = Marca::all();

        return view('modelos.editar', compact('modelo', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $modelo = ModeloVehiculo::find($id);

        if (! $modelo) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'marca_id' => ['required', 'exists:marcas,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $modelo->marca_id = $request->input('marca_id');
        $modelo->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $modelo->imagen;
            $file = $request->file('imagen');
            $nombre = 'modelo_' . $modelo->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('modelos', $nombre, 'public');
            $modelo->imagen = $ruta;

            if ($imagenAnterior && $imagenAnterior !== $ruta && Storage::disk('public')->exists($imagenAnterior)) {
                Storage::disk('public')->delete($imagenAnterior);
            }
        }

        $modelo->save();

        return redirect('/modelos')->with('success', 'Modelo actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $modelo = ModeloVehiculo::with('marca')->find($id);

        if (! $modelo) {
            abort(404);
        }

        return view('modelos.eliminar', compact('modelo'));
    }

    public function destroy($id)
    {
        $modelo = ModeloVehiculo::find($id);

        if (! $modelo) {
            abort(404);
        }

        $imagen = $modelo->imagen;

        try {
            $modelo->productos()->update(['modelo_id' => null]);
            $modelo->delete();
        } catch (\Throwable $e) {
            return redirect('/modelos')->with('error', 'No se pudo eliminar el modelo porque tiene registros relacionados.');
        }

        if ($imagen && Storage::disk('public')->exists($imagen)) {
            Storage::disk('public')->delete($imagen);
        }

        return redirect('/modelos')->with('success', 'Modelo eliminado exitosamente.');
    }
}

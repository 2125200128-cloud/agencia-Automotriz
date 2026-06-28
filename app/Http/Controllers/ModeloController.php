<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\ModeloVehiculo;
use App\Support\PublicImage;
use Illuminate\Http\Request;
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
        $modelo = new ModeloVehiculo();
        $modelo->marca_id = $request->input('marca_id');
        $modelo->nombre = $request->input('nombre');
        $modelo->save();

        if ($request->hasFile('imagen')) {
            $modelo->imagen = $this->guardarImagen($request, $modelo->id);
            $modelo->save();
        }

        return redirect('/modelos')->with('success', 'Modelo guardado exitosamente.');
    }

    public function ver($id)
    {
        $modelo = ModeloVehiculo::with('marca')->find($id);

        if (!$modelo) {
            abort(404);
        }

        return view('modelos.ver', compact('modelo'));
    }

    public function edit($id)
    {
        $modelo = ModeloVehiculo::find($id);

        if (!$modelo) {
            abort(404);
        }

        $marcas = Marca::all();

        return view('modelos.editar', compact('modelo', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $modelo = ModeloVehiculo::find($id);

        if (!$modelo) {
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
            PublicImage::delete($modelo->imagen);
            $modelo->imagen = $this->guardarImagen($request, $modelo->id);
        }

        $modelo->save();

        return redirect('/modelos')->with('success', 'Modelo actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $modelo = ModeloVehiculo::with('marca')->find($id);

        if (!$modelo) {
            abort(404);
        }

        return view('modelos.eliminar', compact('modelo'));
    }

    public function destroy($id)
    {
        $modelo = ModeloVehiculo::find($id);

        if (!$modelo) {
            abort(404);
        }

        PublicImage::delete($modelo->imagen);
        $modelo->delete();

        return redirect('/modelos')->with('success', 'Modelo eliminado exitosamente.');
    }

    private function guardarImagen(Request $request, int $id): string
    {
        $archivo = $request->file('imagen');
        $nombre = 'modelo_' . $id . '.' . $archivo->getClientOriginalExtension();

        return PublicImage::storeAsUrl($archivo, 'modelos', $nombre);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    public function listado()
    {
        $marcas = Marca::all();

        return view('marcas.inicio', compact('marcas'));
    }

    public function inicio()
    {
        return view('marcas.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['required', 'image', 'max:2048'],
        ]);

        $marca = new Marca;
        $marca->nombre = $request->input('nombre');

        $marca->save();

        if ($request->hasFile('imagen')) {
            if ($marca->imagen && Storage::disk('public')->exists($marca->imagen)) {
                Storage::disk('public')->delete($marca->imagen);
            }

            $file = $request->file('imagen');
            $nombre = 'marca_' . $marca->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('marcas', $nombre, 'public');
            $marca->imagen = $ruta;
        }

        $marca->save();

        return redirect('/marcas')->with('success', 'Marca guardada exitosamente.');
    }

    public function ver($id)
    {
        $marca = Marca::find($id);

        if (! $marca) {
            abort(404);
        }

        return view('marcas.ver', compact('marca'));
    }

    public function edit($id)
    {
        $marca = Marca::find($id);

        if (! $marca) {
            abort(404);
        }

        return view('marcas.editar', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (! $marca) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $marca->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $marca->imagen;
            $file = $request->file('imagen');
            $nombre = 'marca_' . $marca->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('marcas', $nombre, 'public');
            $marca->imagen = $ruta;

            if ($imagenAnterior && $imagenAnterior !== $ruta && Storage::disk('public')->exists($imagenAnterior)) {
                Storage::disk('public')->delete($imagenAnterior);
            }
        }

        $marca->save();

        return redirect('/marcas')->with('success', 'Marca actualizada exitosamente.');
    }

    public function eliminar($id)
    {
        $marca = Marca::find($id);

        if (! $marca) {
            abort(404);
        }

        return view('marcas.eliminar', compact('marca'));
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (! $marca) {
            abort(404);
        }

        $imagenes = collect([$marca->imagen])
            ->merge($marca->modelos->pluck('imagen'))
            ->filter()
            ->all();

        try {
            $marca->productos()->update(['marca_id' => null]);

            foreach ($marca->modelos as $modelo) {
                $modelo->productos()->update(['modelo_id' => null]);
                $modelo->delete();
            }

            $marca->delete();
        } catch (\Throwable $e) {
            return redirect('/marcas')->with('error', 'No se pudo eliminar la marca porque tiene registros relacionados.');
        }

        foreach ($imagenes as $imagen) {
            if (Storage::disk('public')->exists($imagen)) {
                Storage::disk('public')->delete($imagen);
            }
        }

        return redirect('/marcas')->with('success', 'Marca eliminada exitosamente.');
    }
}

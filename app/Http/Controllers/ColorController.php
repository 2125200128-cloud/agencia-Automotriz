<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function listado()
    {
        $colores = Color::all();

        return view('colores.inicio', compact('colores'));
    }

    public function inicio()
    {
        return view('colores.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['required', 'image', 'max:2048'],
        ]);

        $color = new Color;
        $color->nombre = $request->input('nombre');

        $color->save();

        if ($request->hasFile('imagen')) {
            if ($color->imagen && Storage::disk('public')->exists($color->imagen)) {
                Storage::disk('public')->delete($color->imagen);
            }

            $file = $request->file('imagen');
            $nombre = 'color_' . $color->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('colores', $nombre, 'public');
            $color->imagen = $ruta;
        }

        $color->save();

        return redirect('/colores')->with('success', 'Color guardado exitosamente.');
    }

    public function ver($id)
    {
        $color = Color::find($id);

        if (! $color) {
            abort(404);
        }

        return view('colores.ver', compact('color'));
    }

    public function edit($id)
    {
        $color = Color::find($id);

        if (! $color) {
            abort(404);
        }

        return view('colores.editar', compact('color'));
    }

    public function update(Request $request, $id)
    {
        $color = Color::find($id);

        if (! $color) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $color->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $imagenAnterior = $color->imagen;
            $file = $request->file('imagen');
            $nombre = 'color_' . $color->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('colores', $nombre, 'public');
            $color->imagen = $ruta;

            if ($imagenAnterior && $imagenAnterior !== $ruta && Storage::disk('public')->exists($imagenAnterior)) {
                Storage::disk('public')->delete($imagenAnterior);
            }
        }

        $color->save();

        return redirect('/colores')->with('success', 'Color actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $color = Color::find($id);

        if (! $color) {
            abort(404);
        }

        return view('colores.eliminar', compact('color'));
    }

    public function destroy($id)
    {
        $color = Color::find($id);

        if (! $color) {
            abort(404);
        }

        $imagen = $color->imagen;

        try {
            $color->productos()->update(['color_id' => null]);
            $color->delete();
        } catch (\Throwable $e) {
            return redirect('/colores')->with('error', 'No se pudo eliminar el color porque tiene registros relacionados.');
        }

        if ($imagen && Storage::disk('public')->exists($imagen)) {
            Storage::disk('public')->delete($imagen);
        }

        return redirect('/colores')->with('success', 'Color eliminado exitosamente.');
    }
}

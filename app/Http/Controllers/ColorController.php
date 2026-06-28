<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Support\PublicImage;
use Illuminate\Http\Request;
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
        $color = new Color();
        $color->nombre = $request->input('nombre');
        $color->save();

        if ($request->hasFile('imagen')) {
            $color->imagen = $this->guardarImagen($request, $color->id);
            $color->save();
        }

        return redirect('/colores')->with('success', 'Color guardado exitosamente.');
    }

    public function ver($id)
    {
        $color = Color::find($id);

        if (!$color) {
            abort(404);
        }

        return view('colores.ver', compact('color'));
    }

    public function edit($id)
    {
        $color = Color::find($id);

        if (!$color) {
            abort(404);
        }

        return view('colores.editar', compact('color'));
    }

    public function update(Request $request, $id)
    {
        $color = Color::find($id);

        if (!$color) {
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
            PublicImage::delete($color->imagen);
            $color->imagen = $this->guardarImagen($request, $color->id);
        }

        $color->save();

        return redirect('/colores')->with('success', 'Color actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $color = Color::find($id);

        if (!$color) {
            abort(404);
        }

        return view('colores.eliminar', compact('color'));
    }

    public function destroy($id)
    {
        $color = Color::find($id);

        if (!$color) {
            abort(404);
        }

        PublicImage::delete($color->imagen);
        $color->delete();

        return redirect('/colores')->with('success', 'Color eliminado exitosamente.');
    }

    private function guardarImagen(Request $request, int $id): string
    {
        $archivo = $request->file('imagen');
        $nombre = 'color_' . $id . '.' . $archivo->getClientOriginalExtension();

        return PublicImage::storeAsUrl($archivo, 'colores', $nombre);
    }
}

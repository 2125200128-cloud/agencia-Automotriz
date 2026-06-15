<?php

namespace App\Http\Controllers;

use App\Models\Color;
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
        $color = new Color;
        $color->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $color->imagen = $request->file('imagen')->store('colores', 'public');
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
            $color->imagen = $request->file('imagen')->store('colores', 'public');
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

        $color->delete();

        return redirect('/colores')->with('success', 'Color eliminado exitosamente.');
    }
}

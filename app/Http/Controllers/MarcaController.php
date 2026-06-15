<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
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
        $marca = new Marca;
        $marca->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $marca->imagen = $request->file('imagen')->store('marcas', 'public');
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
            $marca->imagen = $request->file('imagen')->store('marcas', 'public');
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

        $marca->delete();

        return redirect('/marcas')->with('success', 'Marca eliminada exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Colores',
            'descripcion' => 'Colores disponibles para los vehiculos.',
            'registros' => Color::query()->orderBy('nombre')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombre' => 'Nombre',
                'imagen' => 'Imagen',
            ],
            'urlFormulario' => '/colores/formulario',
        ]);
    }

    public function inicio()
    {
        return view('colores.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        $color = new Color();
        $color->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $color->imagen = $request->file('imagen')->store('colores', 'public');
        }

        $color->save();

        return redirect('/colores');
    }
}

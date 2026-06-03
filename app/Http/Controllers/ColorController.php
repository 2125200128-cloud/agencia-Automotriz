<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function listado()
    {
        $titulo = 'Colores';
        $descripcion = 'Colores disponibles para los vehiculos.';
        $registros = Color::all();
        $columnas = [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
        $urlFormulario = '/colores/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        return view('colores.formulario');
    }

    public function guardar(Request $request)
    {
        $color = new Color();
        $color->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $color->imagen = $request->file('imagen')->store('colores', 'public');
        }

        $color->save();

        return redirect('/colores')->with('success', 'Color guardado exitosamente.');
    }
}

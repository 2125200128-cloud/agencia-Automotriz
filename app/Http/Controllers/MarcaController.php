<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function listado()
    {
        $titulo = 'Marcas';
        $descripcion = 'Marcas disponibles para el catalogo de vehiculos.';
        $registros = Marca::all();
        $columnas = [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
        $urlFormulario = '/marcas/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        return view('marcas.formulario');
    }

    public function guardar(Request $request)
    {
        $marca = new Marca();
        $marca->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $marca->imagen = $request->file('imagen')->store('marcas', 'public');
        }

        $marca->save();

        return redirect('/marcas')->with('success', 'Marca guardada exitosamente.');
    }
}

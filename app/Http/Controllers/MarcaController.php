<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Marcas',
            'descripcion' => 'Marcas disponibles para el catalogo de vehiculos.',
            'registros' => Marca::query()->orderBy('nombre')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombre' => 'Nombre',
                'imagen' => 'Imagen',
            ],
            'urlFormulario' => '/marcas/formulario',
        ]);
    }

    public function inicio()
    {
        return view('marcas.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        $marca = new Marca();
        $marca->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $marca->imagen = $request->file('imagen')->store('marcas', 'public');
        }

        $marca->save();

        return redirect('/marcas');
    }
}

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

    public function formulario()
    {
        return view('marcas.formulario');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('marcas', 'public');
        }

        Marca::create($datos);

        return redirect('/marcas');
    }
}

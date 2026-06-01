<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Tipos',
            'descripcion' => 'Tipos de vehiculo registrados.',
            'registros' => Tipo::query()->orderBy('nombre')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombre' => 'Nombre',
                'imagen' => 'Imagen',
            ],
            'urlFormulario' => '/tipos/formulario',
        ]);
    }

    public function inicio()
    {
        return view('tipos.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        $tipo = new Tipo();
        $tipo->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $tipo->imagen = $request->file('imagen')->store('tipos', 'public');
        }

        $tipo->save();

        return redirect('/tipos');
    }
}

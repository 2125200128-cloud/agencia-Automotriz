<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function listado()
    {
        $titulo = 'Tipos';
        $descripcion = 'Tipos de vehiculo registrados.';
        $registros = Tipo::all();
        $columnas = [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
        $urlFormulario = '/tipos/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        return view('tipos.formulario');
    }

    public function guardar(Request $request)
    {
        $tipo = new Tipo();
        $tipo->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $tipo->imagen = $request->file('imagen')->store('tipos', 'public');
        }

        $tipo->save();

        return redirect('/tipos')->with('success', 'Tipo guardado exitosamente.');
    }
}

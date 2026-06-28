<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Support\PublicImage;
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
        $tipo->save();

        if ($request->hasFile('imagen')) {
            $tipo->imagen = $this->guardarImagen($request, $tipo->id);
            $tipo->save();
        }

        return redirect('/tipos')->with('success', 'Tipo guardado exitosamente.');
    }

    private function guardarImagen(Request $request, int $id): string
    {
        $archivo = $request->file('imagen');
        $nombre = 'tipo_' . $id . '.' . $archivo->getClientOriginalExtension();

        return PublicImage::storeAsUrl($archivo, 'tipos', $nombre);
    }
}

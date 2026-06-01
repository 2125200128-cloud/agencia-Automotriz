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

    public function formulario()
    {
        return view('colores.formulario');
    }
}

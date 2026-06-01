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

    public function formulario()
    {
        return view('tipos.formulario');
    }
}

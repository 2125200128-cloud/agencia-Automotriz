<?php

namespace App\Http\Controllers;

use App\Models\ModeloVehiculo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Modelos',
            'descripcion' => 'Modelos de vehiculo registrados por marca.',
            'registros' => ModeloVehiculo::query()->with('marca')->orderBy('nombre')->get(),
            'columnas' => [
                'id' => 'ID',
                'marca.nombre' => 'Marca',
                'nombre' => 'Nombre',
                'imagen' => 'Imagen',
            ],
            'urlFormulario' => '/modelos/formulario',
        ]);
    }

    public function formulario()
    {
        return view('modelos.formulario');
    }
}

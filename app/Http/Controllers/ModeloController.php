<?php

namespace App\Http\Controllers;

use App\Models\ModeloVehiculo;
use App\Models\Marca;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function listado()
    {
        $titulo = 'Modelos';
        $descripcion = 'Modelos de vehiculo registrados por marca.';
        $registros = ModeloVehiculo::with('marca')->get();
        $columnas = [
            'id' => 'ID',
            'marca.nombre' => 'Marca',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
        $urlFormulario = '/modelos/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        $marcas = Marca::all();

        return view('modelos.formulario', compact('marcas'));
    }

    public function guardar(Request $request)
    {
        $modelo = new ModeloVehiculo();
        $modelo->marca_id = $request->input('marca_id');
        $modelo->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $modelo->imagen = $request->file('imagen')->store('modelos', 'public');
        }

        $modelo->save();

        return redirect('/modelos')->with('success', 'Modelo guardado exitosamente.');
    }
}

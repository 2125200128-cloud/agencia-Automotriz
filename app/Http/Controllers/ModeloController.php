<?php

namespace App\Http\Controllers;

use App\Models\ModeloVehiculo;
use App\Models\Marca;
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

    public function inicio()
    {
        return view('modelos.formulario', [
            'marcas' => Marca::query()->orderBy('nombre')->get(),
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'marca_id' => ['required', 'exists:marcas,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        $modelo = new ModeloVehiculo();
        $modelo->marca_id = $request->input('marca_id');
        $modelo->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            $modelo->imagen = $request->file('imagen')->store('modelos', 'public');
        }

        $modelo->save();

        return redirect('/modelos');
    }
}

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

    public function formulario()
    {
        return view('modelos.formulario', [
            'marcas' => Marca::query()->orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'marca_id' => ['required', 'exists:marcas,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('modelos', 'public');
        }

        ModeloVehiculo::create($datos);

        return redirect('/modelos');
    }
}

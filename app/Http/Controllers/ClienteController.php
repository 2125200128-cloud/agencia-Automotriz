<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Clientes',
            'descripcion' => 'Clientes registrados en la plataforma.',
            'registros' => Cliente::query()->orderBy('nombres')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombres' => 'Nombres',
                'apellidos' => 'Apellidos',
                'correo' => 'Correo',
                'telefono' => 'Telefono',
                'direccion' => 'Direccion',
                'estado' => 'Estado',
            ],
            'urlFormulario' => '/cliente/formulario',
        ]);
    }

    public function formulario()
    {
        return view('cliente.formulario');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clientes,correo'],
            'telefono' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
            'foto' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
        ]);

        $partesNombre = preg_split('/\s+/', trim($datos['nombre']), 2);

        Cliente::create([
            'nombres' => $partesNombre[0],
            'apellidos' => $partesNombre[1] ?? '',
            'correo' => $datos['email'],
            'telefono' => $datos['telefono'],
            'contrasena' => $datos['password'],
            'imagen' => $request->file('foto')?->store('clientes', 'public'),
            'estado' => 'activo',
        ]);

        return redirect('/cliente');
    }
}

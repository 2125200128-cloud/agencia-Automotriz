<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function listado()
    {
        return view('administrador.listado', [
            'administradores' => Administrador::query()->orderBy('nombres')->get(),
        ]);
    }

    public function formulario()
    {
        return view('administrador.formulario');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', 'unique:administradores,correo'],
            'usuario' => ['required', 'string', 'max:255', 'unique:administradores,usuario'],
            'contrasena' => ['required', 'string', 'min:6'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
            'rol' => ['required', 'in:superadministrador,vendedor,capturista'],
            'estado' => ['required', 'in:activo,inactivo'],
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('administradores', 'public');
        }

        Administrador::create($datos);

        return redirect('/administrador');
    }
}

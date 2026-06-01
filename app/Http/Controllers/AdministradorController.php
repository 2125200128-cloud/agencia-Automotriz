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

    public function inicio()
    {
        return view('administrador.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', 'unique:administradores,correo'],
            'usuario' => ['required', 'string', 'max:255', 'unique:administradores,usuario'],
            'contrasena' => ['required', 'string', 'min:6'],
            'imagen' => ['nullable', 'file', 'mimetypes:image/*', 'max:10240'],
            'rol' => ['required', 'in:superadministrador,vendedor,capturista'],
            'estado' => ['required', 'in:activo,inactivo'],
        ]);

        $administrador = new Administrador();
        $administrador->nombres = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->correo = $request->input('correo');
        $administrador->usuario = $request->input('usuario');
        $administrador->contrasena = $request->input('contrasena');
        $administrador->rol = $request->input('rol');
        $administrador->estado = $request->input('estado');

        if ($request->hasFile('imagen')) {
            $administrador->imagen = $request->file('imagen')->store('administradores', 'public');
        }

        $administrador->save();

        return redirect('/administrador');
    }
}

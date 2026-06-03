<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function listado()
    {
        $administradores = Administrador::all();

        return view('administrador.listado', compact('administradores'));
    }

    public function inicio()
    {
        return view('administrador.formulario');
    }

    public function guardar(Request $request)
    {
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

        return redirect('/administrador')->with('success', 'Administrador guardado exitosamente.');
    }
}

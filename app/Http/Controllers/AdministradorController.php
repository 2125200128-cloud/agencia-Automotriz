<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdministradorController extends Controller
{
    public function listado()
    {
        $administradores = Administrador::all();

        return view('administradores.inicio', compact('administradores'));
    }

    public function inicio()
    {
        return view('administradores.formulario');
    }

    public function guardar(Request $request)
    {
        $administrador = new Administrador;
        $administrador->nombres = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->correo = $request->input('correo');
        $administrador->usuario = $request->input('usuario');
        $administrador->contrasena = $request->input('contrasena');
        $administrador->rol = $request->input('rol');
        $administrador->estado = $request->input('estado', 'activo');

        if ($request->hasFile('imagen')) {
            $administrador->imagen = $request->file('imagen')->store('administradores', 'public');
        }

        $administrador->save();

        return redirect('/administrador')->with('success', 'Administrador guardado exitosamente.');
    }

    public function ver($id)
    {
        $administrador = Administrador::find($id);

        if (! $administrador) {
            abort(404);
        }

        return view('administradores.ver', compact('administrador'));
    }

    public function edit($id)
    {
        $administrador = Administrador::find($id);

        if (! $administrador) {
            abort(404);
        }

        return view('administradores.editar', compact('administrador'));
    }

    public function update(Request $request, $id)
    {
        $administrador = Administrador::find($id);

        if (! $administrador) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', Rule::unique('administradores', 'correo')->ignore($administrador->id)],
            'usuario' => ['required', 'string', 'max:255', Rule::unique('administradores', 'usuario')->ignore($administrador->id)],
            'contrasena' => ['nullable', 'string', 'min:6'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'rol' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrador->nombres = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->correo = $request->input('correo');
        $administrador->usuario = $request->input('usuario');
        $administrador->rol = $request->input('rol');
        $administrador->estado = $request->input('estado');

        if ($request->filled('contrasena')) {
            $administrador->contrasena = $request->input('contrasena');
        }

        if ($request->hasFile('imagen')) {
            $administrador->imagen = $request->file('imagen')->store('administradores', 'public');
        }

        $administrador->save();

        return redirect('/administrador')->with('success', 'Administrador actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $administrador = Administrador::find($id);

        if (! $administrador) {
            abort(404);
        }

        return view('administradores.eliminar', compact('administrador'));
    }

    public function destroy($id)
    {
        $administrador = Administrador::find($id);

        if (! $administrador) {
            abort(404);
        }

        $administrador->delete();

        return redirect('/administrador')->with('success', 'Administrador eliminado exitosamente.');
    }
}

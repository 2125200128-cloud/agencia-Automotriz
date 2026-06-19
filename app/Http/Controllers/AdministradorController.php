<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255'],
            'usuario' => ['required', 'string', 'max:255'],
            'contrasena' => ['required', 'string', 'min:6'],
            'imagen' => ['required', 'image', 'max:2048'],
        ]);

        $administrador = new Administrador;
        $administrador->nombres = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->correo = $request->input('correo');
        $administrador->usuario = $request->input('usuario');
        $administrador->contrasena = $request->input('contrasena');
        $administrador->rol = $request->input('rol');
        $administrador->estado = $request->input('estado', 'activo');

        $administrador->save();

        if ($request->hasFile('imagen')) {
            if ($administrador->imagen && Storage::disk('public')->exists($administrador->imagen)) {
                Storage::disk('public')->delete($administrador->imagen);
            }

            $file = $request->file('imagen');
            $nombre = 'administrador_' . $administrador->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('administradores', $nombre, 'public');
            $administrador->imagen = $ruta;
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
            $imagenAnterior = $administrador->imagen;
            $file = $request->file('imagen');
            $nombre = 'administrador_' . $administrador->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('administradores', $nombre, 'public');
            $administrador->imagen = $ruta;

            if ($imagenAnterior && $imagenAnterior !== $ruta && Storage::disk('public')->exists($imagenAnterior)) {
                Storage::disk('public')->delete($imagenAnterior);
            }
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

        $imagen = $administrador->imagen;

        $administrador->delete();

        if ($imagen && Storage::disk('public')->exists($imagen)) {
            Storage::disk('public')->delete($imagen);
        }

        return redirect('/administrador')->with('success', 'Administrador eliminado exitosamente.');
    }
}

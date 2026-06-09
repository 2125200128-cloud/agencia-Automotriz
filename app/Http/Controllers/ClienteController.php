<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function listado()
    {
        $clientes = Cliente::all();

        return view('clientes.inicio', compact('clientes'));
    }

    public function inicio()
    {
        return view('clientes.formulario');
    }

    public function guardar(Request $request)
    {
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');

        if (!$nombres && $request->filled('nombre')) {
            $partesNombre = preg_split('/\s+/', trim($request->input('nombre')), 2);
            $nombres = $partesNombre[0] ?? '';
            $apellidos = $partesNombre[1] ?? '';
        }

        $cliente = new Cliente();
        $cliente->nombres = $nombres;
        $cliente->apellidos = $apellidos;
        $cliente->correo = $request->input('correo', $request->input('email'));
        $cliente->telefono = $request->input('telefono');
        $cliente->contrasena = $request->input('contrasena', $request->input('password'));
        $cliente->direccion = $request->input('direccion');
        $cliente->estado = $request->input('estado', 'activo');

        if ($request->hasFile('imagen')) {
            $cliente->imagen = $request->file('imagen')->store('clientes', 'public');
        } elseif ($request->hasFile('foto')) {
            $cliente->imagen = $request->file('foto')->store('clientes', 'public');
        }

        $cliente->save();

        return redirect('/cliente')->with('success', 'Cliente guardado exitosamente.');
    }

    public function ver($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            abort(404);
        }

        return view('clientes.ver', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            abort(404);
        }

        return view('clientes.editar', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', Rule::unique('clientes', 'correo')->ignore($cliente->id)],
            'telefono' => ['nullable', 'string', 'max:255'],
            'contrasena' => ['nullable', 'string', 'min:6'],
            'direccion' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'estado' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->correo = $request->input('correo');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado = $request->input('estado');

        if ($request->filled('contrasena')) {
            $cliente->contrasena = $request->input('contrasena');
        }

        if ($request->hasFile('imagen')) {
            $cliente->imagen = $request->file('imagen')->store('clientes', 'public');
        }

        $cliente->save();

        return redirect('/cliente')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            abort(404);
        }

        return view('clientes.eliminar', compact('cliente'));
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            abort(404);
        }

        $cliente->delete();

        return redirect('/cliente')->with('success', 'Cliente eliminado exitosamente.');
    }
}

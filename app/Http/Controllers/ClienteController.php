<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function listado()
    {
        $clientes = Cliente::all();

        return view('cliente.listado', compact('clientes'));
    }

    public function inicio()
    {
        return view('cliente.formulario');
    }

    public function guardar(Request $request)
    {
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');

        if (! $nombres && $request->filled('nombre')) {
            $partesNombre = preg_split('/\s+/', trim($request->input('nombre')), 2);
            $nombres = $partesNombre[0] ?? '';
            $apellidos = $partesNombre[1] ?? '';
        }

        $cliente = new Cliente;
        $cliente->nombres = $nombres;
        $cliente->apellidos = $apellidos;
        $cliente->correo = $request->input('correo', $request->input('email'));
        $cliente->telefono = $request->input('telefono');
        $cliente->contrasena = $request->input('contrasena', $request->input('password'));
        $cliente->direccion = $request->input('direccion');
        $cliente->estado = $request->input('estado', 'activo');

        $cliente->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
        } elseif ($request->hasFile('foto')) {
            $file = $request->file('foto');
        }

        if (isset($file)) {
            $nombre = 'cliente_' . $cliente->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('clientes', $nombre, 'public');
            $cliente->imagen = $ruta;
        }

        $cliente->save();

        return redirect('/cliente')->with('success', 'Cliente guardado exitosamente.');
    }

    public function ver($id)
    {
        $cliente = Cliente::find($id);

        if (! $cliente) {
            abort(404);
        }

        return redirect('/cliente');
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if (! $cliente) {
            abort(404);
        }

        return redirect('/cliente');
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (! $cliente) {
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
            $imagenAnterior = $cliente->imagen;
            $file = $request->file('imagen');
            $nombre = 'cliente_' . $cliente->getKey() . '.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('clientes', $nombre, 'public');
            $cliente->imagen = $ruta;

            if ($imagenAnterior && $imagenAnterior !== $ruta && Storage::disk('public')->exists($imagenAnterior)) {
                Storage::disk('public')->delete($imagenAnterior);
            }
        }

        $cliente->save();

        return redirect('/cliente')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $cliente = Cliente::find($id);

        if (! $cliente) {
            abort(404);
        }

        return redirect('/cliente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (! $cliente) {
            abort(404);
        }

        $imagen = $cliente->imagen;

        try {
            DB::transaction(function () use ($cliente) {
                foreach ($cliente->pedidos as $pedido) {
                    $pedido->pagos()->delete();
                    $pedido->productosPedido()->delete();
                    $pedido->delete();
                }

                $cliente->delete();
            });
        } catch (\Throwable $e) {
            return redirect('/cliente')->with('error', 'No se pudo eliminar el cliente porque tiene registros relacionados.');
        }

        if ($imagen && Storage::disk('public')->exists($imagen)) {
            Storage::disk('public')->delete($imagen);
        }

        return redirect('/cliente')->with('success', 'Cliente eliminado exitosamente.');
    }
}

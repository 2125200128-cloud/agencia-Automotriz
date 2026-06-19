<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function listado()
    {
        $proveedores = Proveedor::all();

        return view('proveedor.listado', compact('proveedores'));
    }

    public function inicio()
    {
        return view('proveedor.formulario');
    }

    public function guardar(Request $request)
    {
        $proveedor = new Proveedor;
        $proveedor->nombre = $request->input('nombre', $request->input('nombre_empresa'));
        $proveedor->contacto = $request->input('contacto', $request->input('nombre_representante'));
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo', $request->input('email'));
        $proveedor->direccion = $request->input('direccion');
        $proveedor->estado = $request->input('estado', 'activo');
        $proveedor->save();

        return redirect('/proveedor')->with('success', 'Proveedor guardado exitosamente.');
    }

    public function ver($id)
    {
        $proveedor = Proveedor::find($id);

        if (! $proveedor) {
            abort(404);
        }

        return view('proveedores.ver', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        if (! $proveedor) {
            abort(404);
        }

        return view('proveedores.editar', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);

        if (! $proveedor) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'contacto' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:255'],
            'correo' => ['nullable', 'email', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'estado' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $proveedor->nombre = $request->input('nombre');
        $proveedor->contacto = $request->input('contacto');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->estado = $request->input('estado');
        $proveedor->save();

        return redirect('/proveedor')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        $proveedor = Proveedor::find($id);

        if (! $proveedor) {
            abort(404);
        }

        return view('proveedores.eliminar', compact('proveedor'));
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        if (! $proveedor) {
            abort(404);
        }

        $proveedor->delete();

        return redirect('/proveedor')->with('success', 'Proveedor eliminado exitosamente.');
    }
}

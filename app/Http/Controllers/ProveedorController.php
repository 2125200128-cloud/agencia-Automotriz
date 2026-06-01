<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Proveedores',
            'descripcion' => 'Directorio de proveedores registrados.',
            'registros' => Proveedor::query()->orderBy('nombre')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombre' => 'Nombre',
                'contacto' => 'Contacto',
                'telefono' => 'Telefono',
                'correo' => 'Correo',
                'direccion' => 'Direccion',
                'estado' => 'Estado',
            ],
            'urlFormulario' => '/proveedor/formulario',
        ]);
    }

    public function inicio()
    {
        return view('proveedor.formulario');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre_empresa' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'nombre_representante' => ['required', 'string', 'max:255'],
        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->input('nombre_empresa');
        $proveedor->contacto = $request->input('nombre_representante');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('email');
        $proveedor->estado = 'activo';
        $proveedor->save();

        return redirect('/proveedor');
    }
}

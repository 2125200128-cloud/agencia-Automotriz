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

    public function formulario()
    {
        return view('proveedor.formulario');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre_empresa' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'nombre_representante' => ['required', 'string', 'max:255'],
        ]);

        Proveedor::create([
            'nombre' => $datos['nombre_empresa'],
            'contacto' => $datos['nombre_representante'],
            'telefono' => $datos['telefono'],
            'correo' => $datos['email'],
            'estado' => 'activo',
        ]);

        return redirect('/proveedor');
    }
}

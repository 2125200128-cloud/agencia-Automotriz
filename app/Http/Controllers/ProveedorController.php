<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function listado()
    {
        $titulo = 'Proveedores';
        $descripcion = 'Directorio de proveedores registrados.';
        $registros = Proveedor::all();
        $columnas = [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'contacto' => 'Contacto',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
            'direccion' => 'Direccion',
            'estado' => 'Estado',
        ];
        $urlFormulario = '/proveedor/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        return view('proveedor.formulario');
    }

    public function guardar(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->input('nombre_empresa');
        $proveedor->contacto = $request->input('nombre_representante');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('email');
        $proveedor->estado = 'activo';
        $proveedor->save();

        return redirect('/proveedor')->with('success', 'Proveedor guardado exitosamente.');
    }
}

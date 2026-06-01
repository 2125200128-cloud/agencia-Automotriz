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
}

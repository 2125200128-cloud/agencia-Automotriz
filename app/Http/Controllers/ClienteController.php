<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Clientes',
            'descripcion' => 'Clientes registrados en la plataforma.',
            'registros' => Cliente::query()->orderBy('nombres')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombres' => 'Nombres',
                'apellidos' => 'Apellidos',
                'correo' => 'Correo',
                'telefono' => 'Telefono',
                'direccion' => 'Direccion',
                'estado' => 'Estado',
            ],
            'urlFormulario' => '/cliente/formulario',
        ]);
    }

    public function formulario()
    {
        return view('cliente.formulario');
    }
}

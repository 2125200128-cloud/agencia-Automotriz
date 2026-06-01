<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Administradores',
            'descripcion' => 'Personal autorizado registrado en el sistema.',
            'registros' => Administrador::query()->orderBy('nombres')->get(),
            'columnas' => [
                'id' => 'ID',
                'nombres' => 'Nombres',
                'apellidos' => 'Apellidos',
                'correo' => 'Correo',
                'usuario' => 'Usuario',
                'rol' => 'Rol',
                'estado' => 'Estado',
            ],
            'urlFormulario' => '/administrador/formulario',
        ]);
    }

    public function formulario()
    {
        return view('administrador.formulario');
    }
}

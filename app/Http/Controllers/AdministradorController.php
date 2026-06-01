<?php namespace App\Http\Controllers; 
use Illuminate\Http\Request; class AdministradorController extends Controller
 { public function listado() { return view("administrador.listado"); } public function formulario() 
 { return view("administrador.formulario"); } }

<?php namespace App\Http\Controllers;
 use Illuminate\Http\Request; class ProductoController 
 extends Controller 
 { public function listado()
  { return view("productoauto.listado"); } public function formulario() { return view("productoauto.formulario"); } }

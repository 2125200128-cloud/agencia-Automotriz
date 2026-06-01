<?php namespace App\Http\Controllers;
 use Illuminate\Http\Request; class PedidoController extends Controller 
 { public function listado()
  { return view("pedido.listado"); } }

<?php namespace App\Http\Controllers;
 use Illuminate\Http\Request;
  class ClienteController 
  extends Controller { public function listado() 
  { return view("cliente.listado"); 
  }
  public function formulario()  
  { 
    return view("cliente.formulario"); 
  } public function cita() 
  { 
    return view("cliente.cita");
     } public function compra()
 {
         return view("cliente.compra"); 
    } public function misPedidos() 
    {
         return view("cliente.mis-pedidos"); 
    } 
    }

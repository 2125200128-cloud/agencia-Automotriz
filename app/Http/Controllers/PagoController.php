<?php namespace App\Http\Controllers; 
use Illuminate\Http\Request; class PagoController extends Controller 
{ public function listado()
 { return view("pagos.listado"); } }

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function listado()
    {
        $pedidos = Pedido::query()
            ->with(['cliente', 'productos', 'pagos'])
            ->get();

        return view('pedido.listado', compact('pedidos'));
    }

    public function inicio()
    {
        $clientes = Cliente::all();

        return view('pedido.formulario', compact('clientes'));
    }

    public function guardar(Request $request)
    {
        $pedido = new Pedido;
        $pedido->cliente_id = $request->input('cliente_id');
        $pedido->fecha = $request->input('fecha');
        $pedido->descuento = $request->input('descuento');
        $pedido->iva = $request->input('iva');
        $pedido->total = $request->input('total');
        $pedido->estado = $request->input('estado');
        $pedido->save();

        return redirect('/pedido')->with('success', 'Pedido guardado exitosamente.');
    }
}

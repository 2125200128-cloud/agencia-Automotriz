<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class PedidoController extends Controller
{
    public function listado()
    {
        $pedidos = Pedido::query()
            ->with(['cliente', 'productos', 'pagos'])
            ->orderByDesc('fecha')
            ->get();

        return view('pedido.listado', compact('pedidos'));
    }
}

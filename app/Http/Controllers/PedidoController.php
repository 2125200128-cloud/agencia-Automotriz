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
            ->orderByDesc('fecha')
            ->get();

        return view('pedido.listado', compact('pedidos'));
    }

    public function inicio()
    {
        return view('pedido.formulario', [
            'clientes' => Cliente::query()->orderBy('nombres')->get(),
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'fecha' => ['required', 'date'],
            'descuento' => ['required', 'numeric', 'min:0'],
            'iva' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'estado' => ['required', 'in:pendiente,confirmado,completado,cancelado'],
        ]);

        $pedido = new Pedido();
        $pedido->cliente_id = $request->input('cliente_id');
        $pedido->fecha = $request->input('fecha');
        $pedido->descuento = $request->input('descuento');
        $pedido->iva = $request->input('iva');
        $pedido->total = $request->input('total');
        $pedido->estado = $request->input('estado');
        $pedido->save();

        return redirect('/pedido');
    }
}

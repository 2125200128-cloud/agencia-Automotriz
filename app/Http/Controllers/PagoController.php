<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function listado()
    {
        $pagos = Pago::query()
            ->with('pedido.cliente')
            ->get();

        return view('pagos.listado', compact('pagos'));
    }

    public function inicio()
    {
        $pedidos = Pedido::all();

        return view('pagos.formulario', compact('pedidos'));
    }

    public function guardar(Request $request)
    {
        $pago = new Pago();
        $pago->pedido_id = $request->input('pedido_id');
        $pago->metodo_pago = $request->input('metodo_pago');
        $pago->monto = $request->input('monto');
        $pago->fecha_pago = $request->input('fecha_pago');
        $pago->estado = $request->input('estado');
        $pago->save();

        return redirect('/pagos')->with('success', 'Pago guardado exitosamente.');
    }
}

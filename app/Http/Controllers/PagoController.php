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
            ->orderByDesc('fecha_pago')
            ->get();

        return view('pagos.listado', compact('pagos'));
    }

    public function inicio()
    {
        return view('pagos.formulario', [
            'pedidos' => Pedido::query()->orderByDesc('id')->get(),
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'pedido_id' => ['required', 'exists:pedidos,id'],
            'metodo_pago' => ['required', 'string', 'max:255'],
            'monto' => ['required', 'numeric', 'min:0'],
            'fecha_pago' => ['required', 'date'],
            'estado' => ['required', 'in:pendiente,completado,cancelado'],
        ]);

        $pago = new Pago();
        $pago->pedido_id = $request->input('pedido_id');
        $pago->metodo_pago = $request->input('metodo_pago');
        $pago->monto = $request->input('monto');
        $pago->fecha_pago = $request->input('fecha_pago');
        $pago->estado = $request->input('estado');
        $pago->save();

        return redirect('/pagos');
    }
}

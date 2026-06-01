<?php

namespace App\Http\Controllers;

use App\Models\Pago;

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
}

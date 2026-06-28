<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\ProductoPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        $productos = Producto::query()
            ->where('estado', 'activo')
            ->where('existencia', '>', 0)
            ->orderBy('nombre')
            ->get();

        return view('pedido.formulario', compact('clientes', 'productos'));
    }

    public function guardar(Request $request)
    {
        $datos = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'producto_id' => ['required', 'exists:productos,id'],
            'fecha' => ['required', 'date'],
            'cantidad' => ['required', 'integer', 'min:1'],
            'descuento' => ['nullable', 'numeric', 'min:0'],
            'iva' => ['nullable', 'numeric', 'min:0'],
            'estado' => ['required', Rule::in(['pendiente', 'confirmado', 'completado', 'cancelado'])],
            'metodo_pago' => ['required', Rule::in(['efectivo', 'transferencia', 'tarjeta', 'financiamiento'])],
            'monto_pago' => ['nullable', 'numeric', 'min:0'],
            'estado_pago' => ['required', Rule::in(['pendiente', 'completado', 'cancelado'])],
        ]);

        DB::transaction(function () use ($datos) {
            $producto = Producto::query()
                ->whereKey($datos['producto_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($producto->existencia < $datos['cantidad']) {
                abort(422, 'No hay existencia suficiente para vender este vehiculo.');
            }

            $descuento = (float) ($datos['descuento'] ?? 0);
            $iva = (float) ($datos['iva'] ?? 0);
            $precio = (float) $producto->precio;
            $total = max(0, ($precio * (int) $datos['cantidad']) - $descuento + $iva);

            $pedido = Pedido::create([
                'cliente_id' => $datos['cliente_id'],
                'fecha' => $datos['fecha'],
                'descuento' => $descuento,
                'iva' => $iva,
                'total' => $total,
                'estado' => $datos['estado'],
            ]);

            ProductoPedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id,
                'cantidad' => $datos['cantidad'],
                'precio' => $precio,
                'descuento' => $descuento,
            ]);

            Pago::create([
                'pedido_id' => $pedido->id,
                'metodo_pago' => $datos['metodo_pago'],
                'monto' => $datos['monto_pago'] ?? $total,
                'fecha_pago' => $datos['fecha'],
                'estado' => $datos['estado_pago'],
            ]);

            $producto->existencia = $producto->existencia - (int) $datos['cantidad'];
            $producto->save();
        });

        return redirect('/pedido')->with('success', 'Pedido guardado exitosamente.');
    }
}

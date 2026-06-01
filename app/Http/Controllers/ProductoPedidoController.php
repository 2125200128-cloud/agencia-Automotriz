<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\ProductoPedido;
use Illuminate\Http\Request;

class ProductoPedidoController extends Controller
{
    public function listado()
    {
        return view('catalogos.listado', [
            'titulo' => 'Productos de pedidos',
            'descripcion' => 'Detalle de productos registrados en cada pedido.',
            'registros' => ProductoPedido::query()
                ->with(['pedido.cliente', 'producto'])
                ->orderByDesc('id')
                ->get(),
            'columnas' => [
                'id' => 'ID',
                'pedido_id' => 'Pedido',
                'pedido.cliente.correo' => 'Cliente',
                'producto.nombre' => 'Producto',
                'cantidad' => 'Cantidad',
                'precio' => 'Precio',
                'descuento' => 'Descuento',
            ],
            'urlFormulario' => '/productos-pedido/formulario',
        ]);
    }

    public function formulario()
    {
        return view('productos_pedido.formulario', [
            'pedidos' => Pedido::query()->orderByDesc('id')->get(),
            'productos' => Producto::query()->orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request)
    {
        ProductoPedido::create($request->validate([
            'pedido_id' => ['required', 'exists:pedidos,id'],
            'producto_id' => ['required', 'exists:productos,id'],
            'cantidad' => ['required', 'integer', 'min:1'],
            'precio' => ['required', 'numeric', 'min:0'],
            'descuento' => ['nullable', 'numeric', 'min:0'],
        ]));

        return redirect('/productos-pedido');
    }
}

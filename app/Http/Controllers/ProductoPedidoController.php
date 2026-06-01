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

    public function inicio()
    {
        return view('productos_pedido.formulario', [
            'pedidos' => Pedido::query()->orderByDesc('id')->get(),
            'productos' => Producto::query()->orderBy('nombre')->get(),
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'pedido_id' => ['required', 'exists:pedidos,id'],
            'producto_id' => ['required', 'exists:productos,id'],
            'cantidad' => ['required', 'integer', 'min:1'],
            'precio' => ['required', 'numeric', 'min:0'],
            'descuento' => ['nullable', 'numeric', 'min:0'],
        ]);

        $productoPedido = new ProductoPedido();
        $productoPedido->pedido_id = $request->input('pedido_id');
        $productoPedido->producto_id = $request->input('producto_id');
        $productoPedido->cantidad = $request->input('cantidad');
        $productoPedido->precio = $request->input('precio');
        $productoPedido->descuento = $request->input('descuento');
        $productoPedido->save();

        return redirect('/productos-pedido');
    }
}

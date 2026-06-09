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
        $titulo = 'Productos de pedidos';
        $descripcion = 'Detalle de productos registrados en cada pedido.';
        $registros = ProductoPedido::with(['pedido.cliente', 'producto'])->get();
        $columnas = [
            'id' => 'ID',
            'pedido_id' => 'Pedido',
            'pedido.cliente.correo' => 'Cliente',
            'producto.nombre' => 'Producto',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'descuento' => 'Descuento',
        ];
        $urlFormulario = '/productos-pedido/formulario';

        return view('catalogos.listado', compact('titulo', 'descripcion', 'registros', 'columnas', 'urlFormulario'));
    }

    public function inicio()
    {
        $pedidos = Pedido::all();
        $productos = Producto::all();

        return view('productos_pedido.formulario', compact('pedidos', 'productos'));
    }

    public function guardar(Request $request)
    {
        $productoPedido = new ProductoPedido;
        $productoPedido->pedido_id = $request->input('pedido_id');
        $productoPedido->producto_id = $request->input('producto_id');
        $productoPedido->cantidad = $request->input('cantidad');
        $productoPedido->precio = $request->input('precio');
        $productoPedido->descuento = $request->input('descuento');
        $productoPedido->save();

        return redirect('/productos-pedido')->with('success', 'Producto de pedido guardado exitosamente.');
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\ProductoPedidoController;
use App\Http\Controllers\InicioController;

Route::get('/', [InicioController::class, 'inicio']);

// Route::get('/administrador', [AdministradorController::class, 'listado']);
Route::get('/administrador', [AdministradorController::class, 'listado']);
// Route::view('/administrador/formulario', 'administrador.formulario');
Route::get('/administrador/formulario', [AdministradorController::class, 'formulario']);
Route::post('/administrador', [AdministradorController::class, 'store']);

// Route::view('/cliente', 'cliente.listado');
Route::get('/cliente', [ClienteController::class, 'listado']);
// Route::view('/cliente/formulario', 'cliente.formulario');
Route::get('/cliente/formulario', [ClienteController::class, 'formulario']);
Route::post('/cliente', [ClienteController::class, 'store']);
Route::view('/cliente/cita', 'cliente.cita');
Route::view('/cliente/compra', 'cliente.compra');

// Route::view('/pedido', 'pedido.listado');
Route::get('/pedido', [PedidoController::class, 'listado']);

// Route::view('/producto', 'productoauto.listado');
Route::get('/producto', [ProductoController::class, 'listado']);
// Route::view('/producto/formulario', 'productoauto.formulario');
Route::get('/producto/formulario', [ProductoController::class, 'formulario']);
Route::post('/producto', [ProductoController::class, 'store']);

// Route::view('/proveedor', 'proveedor.listado');
Route::get('/proveedor', [ProveedorController::class, 'listado']);
// Route::view('/proveedor/formulario', 'proveedor.formulario');
Route::get('/proveedor/formulario', [ProveedorController::class, 'formulario']);
Route::post('/proveedor', [ProveedorController::class, 'store']);

// Route::view('/pagos', 'pagos.listado');
Route::get('/pagos', [PagoController::class, 'listado']);

Route::get('/marcas', [MarcaController::class, 'listado']);
// Route::view('/marcas/formulario', 'marcas.formulario');
Route::get('/marcas/formulario', [MarcaController::class, 'formulario']);
Route::post('/marcas', [MarcaController::class, 'store']);
Route::get('/modelos', [ModeloController::class, 'listado']);
// Route::view('/modelos/formulario', 'modelos.formulario');
Route::get('/modelos/formulario', [ModeloController::class, 'formulario']);
Route::post('/modelos', [ModeloController::class, 'store']);
Route::get('/colores', [ColorController::class, 'listado']);
// Route::view('/colores/formulario', 'colores.formulario');
Route::get('/colores/formulario', [ColorController::class, 'formulario']);
Route::post('/colores', [ColorController::class, 'store']);
Route::get('/tipos', [TipoController::class, 'listado']);
// Route::view('/tipos/formulario', 'tipos.formulario');
Route::get('/tipos/formulario', [TipoController::class, 'formulario']);
Route::post('/tipos', [TipoController::class, 'store']);
// Route::view('/productos-pedido/formulario', 'productos_pedido.formulario');
Route::get('/productos-pedido', [ProductoPedidoController::class, 'listado']);
Route::get('/productos-pedido/formulario', [ProductoPedidoController::class, 'formulario']);
Route::post('/productos-pedido', [ProductoPedidoController::class, 'store']);

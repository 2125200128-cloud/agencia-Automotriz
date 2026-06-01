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

Route::view('/', 'inicio');

// RUTAS VIEJAS COMENTADAS
// Route::get('/administrador', [AdministradorController::class, 'listado']);
// Route::view('/administrador/formulario', 'administrador.formulario');
// Route::view('/cliente', 'cliente.listado');
// Route::view('/cliente/formulario', 'cliente.formulario');
// Route::view('/cliente/cita', 'cliente.cita');
// Route::view('/cliente/compra', 'cliente.compra');
// Route::view('/cliente/mis-pedidos', 'cliente.mis-pedidos');
// Route::view('/pedido', 'pedido.listado');
// Route::view('/producto', 'productoauto.listado');
// Route::view('/producto/formulario', 'productoauto.formulario');
// Route::view('/proveedor', 'proveedor.listado');
// Route::view('/proveedor/formulario', 'proveedor.formulario');
// Route::view('/pagos', 'pagos.listado');
// Route::view('/marcas/formulario', 'marcas.formulario');
// Route::view('/modelos/formulario', 'modelos.formulario');
// Route::view('/colores/formulario', 'colores.formulario');
// Route::view('/tipos/formulario', 'tipos.formulario');
// Route::view('/productos-pedido/formulario', 'productos_pedido.formulario');

// NUEVAS RUTAS CON CONTROLADORES
Route::get('/administrador', [AdministradorController::class, 'listado']);
Route::get('/administrador/formulario', [AdministradorController::class, 'formulario']);

Route::get('/cliente', [ClienteController::class, 'listado']);
Route::get('/cliente/formulario', [ClienteController::class, 'formulario']);

Route::get('/pedido', [PedidoController::class, 'listado']);

Route::get('/producto', [ProductoController::class, 'listado']);
Route::get('/producto/formulario', [ProductoController::class, 'formulario']);

Route::get('/proveedor', [ProveedorController::class, 'listado']);
Route::get('/proveedor/formulario', [ProveedorController::class, 'formulario']);

Route::get('/pagos', [PagoController::class, 'listado']);

Route::get('/marcas', [MarcaController::class, 'listado']);
Route::get('/marcas/formulario', [MarcaController::class, 'formulario']);
Route::get('/modelos', [ModeloController::class, 'listado']);
Route::get('/modelos/formulario', [ModeloController::class, 'formulario']);
Route::get('/colores', [ColorController::class, 'listado']);
Route::get('/colores/formulario', [ColorController::class, 'formulario']);
Route::get('/tipos', [TipoController::class, 'listado']);
Route::get('/tipos/formulario', [TipoController::class, 'formulario']);
Route::get('/productos-pedido/formulario', [ProductoPedidoController::class, 'formulario']);

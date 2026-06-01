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
Route::get('/administrador/formulario', [AdministradorController::class, 'inicio']);
Route::post('/administrador', [AdministradorController::class, 'guardar']);

// Route::view('/cliente', 'cliente.listado');
Route::get('/cliente', [ClienteController::class, 'listado']);
// Route::view('/cliente/formulario', 'cliente.formulario');
Route::get('/cliente/formulario', [ClienteController::class, 'inicio']);
Route::post('/cliente', [ClienteController::class, 'guardar']);
Route::view('/cliente/cita', 'cliente.cita');
Route::view('/cliente/compra', 'cliente.compra');

// Route::view('/pedido', 'pedido.listado');
Route::get('/pedido', [PedidoController::class, 'listado']);
Route::get('/pedido/formulario', [PedidoController::class, 'inicio']);
Route::post('/pedido', [PedidoController::class, 'guardar']);

// Route::view('/producto', 'productoauto.listado');
Route::get('/producto', [ProductoController::class, 'listado']);
// Route::view('/producto/formulario', 'productoauto.formulario');
Route::get('/producto/formulario', [ProductoController::class, 'inicio']);
Route::post('/producto', [ProductoController::class, 'guardar']);

// Route::view('/proveedor', 'proveedor.listado');
Route::get('/proveedor', [ProveedorController::class, 'listado']);
// Route::view('/proveedor/formulario', 'proveedor.formulario');
Route::get('/proveedor/formulario', [ProveedorController::class, 'inicio']);
Route::post('/proveedor', [ProveedorController::class, 'guardar']);

// Route::view('/pagos', 'pagos.listado');
Route::get('/pagos', [PagoController::class, 'listado']);
Route::get('/pagos/formulario', [PagoController::class, 'inicio']);
Route::post('/pagos', [PagoController::class, 'guardar']);

Route::view('/catalogos', 'catalogos.inicio');
Route::get('/marcas', [MarcaController::class, 'listado']);
// Route::view('/marcas/formulario', 'marcas.formulario');
Route::get('/marcas/formulario', [MarcaController::class, 'inicio']);
Route::post('/marcas', [MarcaController::class, 'guardar']);
Route::get('/modelos', [ModeloController::class, 'listado']);
// Route::view('/modelos/formulario', 'modelos.formulario');
Route::get('/modelos/formulario', [ModeloController::class, 'inicio']);
Route::post('/modelos', [ModeloController::class, 'guardar']);
Route::get('/colores', [ColorController::class, 'listado']);
// Route::view('/colores/formulario', 'colores.formulario');
Route::get('/colores/formulario', [ColorController::class, 'inicio']);
Route::post('/colores', [ColorController::class, 'guardar']);
Route::get('/tipos', [TipoController::class, 'listado']);
// Route::view('/tipos/formulario', 'tipos.formulario');
Route::get('/tipos/formulario', [TipoController::class, 'inicio']);
Route::post('/tipos', [TipoController::class, 'guardar']);
// Route::view('/productos-pedido/formulario', 'productos_pedido.formulario');
Route::get('/productos-pedido', [ProductoPedidoController::class, 'listado']);
Route::get('/productos-pedido/formulario', [ProductoPedidoController::class, 'inicio']);
Route::post('/productos-pedido', [ProductoPedidoController::class, 'guardar']);

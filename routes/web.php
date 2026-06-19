<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoPedidoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TopbarInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio']);
Route::get('/topbar-info', [TopbarInfoController::class, 'show'])->name('topbar.info');

Route::get('/administrador', [AdministradorController::class, 'listado']);
Route::get('/administrador/formulario', [AdministradorController::class, 'inicio']);
Route::post('/administrador', [AdministradorController::class, 'guardar']);
Route::get('/administrador/{id}', [AdministradorController::class, 'ver']);
Route::get('/administrador/{id}/editar', [AdministradorController::class, 'edit']);
Route::put('/administrador/{id}', [AdministradorController::class, 'update']);
Route::get('/administrador/{id}/eliminar', [AdministradorController::class, 'eliminar']);
Route::delete('/administrador/{id}', [AdministradorController::class, 'destroy']);

Route::get('/cliente', [ClienteController::class, 'listado']);
Route::get('/cliente/formulario', [ClienteController::class, 'inicio']);
Route::post('/cliente', [ClienteController::class, 'guardar']);
Route::view('/cliente/cita', 'clientes.cita');
Route::view('/cliente/compra', 'clientes.compra');
Route::view('/cliente/mis-pedidos', 'clientes.mis-pedidos');
Route::get('/cliente/{id}', [ClienteController::class, 'ver']);
Route::get('/cliente/{id}/editar', [ClienteController::class, 'edit']);
Route::put('/cliente/{id}', [ClienteController::class, 'update']);
Route::get('/cliente/{id}/eliminar', [ClienteController::class, 'eliminar']);
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy']);

Route::get('/pedido', [PedidoController::class, 'listado']);
Route::get('/pedido/formulario', [PedidoController::class, 'inicio']);
Route::post('/pedido', [PedidoController::class, 'guardar']);

Route::get('/producto', [ProductoController::class, 'listado']);
Route::get('/producto/formulario', [ProductoController::class, 'inicio']);
Route::post('/producto', [ProductoController::class, 'guardar']);
Route::get('/producto/{id}', [ProductoController::class, 'ver']);
Route::get('/producto/{id}/editar', [ProductoController::class, 'edit']);
Route::put('/producto/{id}', [ProductoController::class, 'update']);
Route::get('/producto/{id}/eliminar', [ProductoController::class, 'eliminar']);
Route::delete('/producto/{id}', [ProductoController::class, 'destroy']);

Route::get('/proveedor', [ProveedorController::class, 'listado']);
Route::get('/proveedor/formulario', [ProveedorController::class, 'inicio']);
Route::post('/proveedor', [ProveedorController::class, 'guardar']);
Route::get('/proveedor/{id}', [ProveedorController::class, 'ver']);
Route::get('/proveedor/{id}/editar', [ProveedorController::class, 'edit']);
Route::put('/proveedor/{id}', [ProveedorController::class, 'update']);
Route::get('/proveedor/{id}/eliminar', [ProveedorController::class, 'eliminar']);
Route::delete('/proveedor/{id}', [ProveedorController::class, 'destroy']);

Route::get('/pagos', [PagoController::class, 'listado']);
Route::get('/pagos/formulario', [PagoController::class, 'inicio']);
Route::post('/pagos', [PagoController::class, 'guardar']);

Route::get('/marcas', [MarcaController::class, 'listado']);
Route::get('/marcas/formulario', [MarcaController::class, 'inicio']);
Route::post('/marcas', [MarcaController::class, 'guardar']);
Route::get('/marcas/{id}', [MarcaController::class, 'ver']);
Route::get('/marcas/{id}/editar', [MarcaController::class, 'edit']);
Route::put('/marcas/{id}', [MarcaController::class, 'update']);
Route::get('/marcas/{id}/eliminar', [MarcaController::class, 'eliminar']);
Route::delete('/marcas/{id}', [MarcaController::class, 'destroy']);
Route::get('/modelos', [ModeloController::class, 'listado']);
Route::get('/modelos/formulario', [ModeloController::class, 'inicio']);
Route::post('/modelos', [ModeloController::class, 'guardar']);
Route::get('/modelos/{id}', [ModeloController::class, 'ver']);
Route::get('/modelos/{id}/editar', [ModeloController::class, 'edit']);
Route::put('/modelos/{id}', [ModeloController::class, 'update']);
Route::get('/modelos/{id}/eliminar', [ModeloController::class, 'eliminar']);
Route::delete('/modelos/{id}', [ModeloController::class, 'destroy']);
Route::get('/colores', [ColorController::class, 'listado']);
Route::get('/colores/formulario', [ColorController::class, 'inicio']);
Route::post('/colores', [ColorController::class, 'guardar']);
Route::get('/colores/{id}', [ColorController::class, 'ver']);
Route::get('/colores/{id}/editar', [ColorController::class, 'edit']);
Route::put('/colores/{id}', [ColorController::class, 'update']);
Route::get('/colores/{id}/eliminar', [ColorController::class, 'eliminar']);
Route::delete('/colores/{id}', [ColorController::class, 'destroy']);
Route::get('/tipos', [TipoController::class, 'listado']);
Route::get('/tipos/formulario', [TipoController::class, 'inicio']);
Route::post('/tipos', [TipoController::class, 'guardar']);
Route::get('/tipos/{id}', [TipoController::class, 'ver']);
Route::get('/tipos/{id}/editar', [TipoController::class, 'edit']);
Route::put('/tipos/{id}', [TipoController::class, 'update']);
Route::get('/tipos/{id}/eliminar', [TipoController::class, 'eliminar']);
Route::delete('/tipos/{id}', [TipoController::class, 'destroy']);
Route::get('/productos-pedido', [ProductoPedidoController::class, 'listado']);
Route::get('/productos-pedido/formulario', [ProductoPedidoController::class, 'inicio']);
Route::post('/productos-pedido', [ProductoPedidoController::class, 'guardar']);

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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClienteSocialAuthController;

Route::get('/', [InicioController::class, 'publico'])->name('inicio');
Route::redirect('/login', '/');
Route::get('/veloce-interno', [LoginController::class, 'show'])->name('login');
Route::post('/veloce-interno', [LoginController::class, 'login']);

Route::get('/cliente/cita', [ClienteController::class, 'citaFormulario'])->name('cliente.cita');
Route::post('/cliente/cita', [ClienteController::class, 'guardarCita'])->name('cliente.cita.guardar');
Route::post('/cliente/cita/validar', [ClienteController::class, 'validarLicencia']);
Route::post('/cliente', [ClienteController::class, 'guardar']);
Route::get('/cliente/login', [ClienteSocialAuthController::class, 'showLogin'])->name('cliente.login');
Route::get('/cliente/login/google', [ClienteSocialAuthController::class, 'redirectToGoogle'])->name('cliente.google.redirect');
Route::get('/cliente/login/google/callback', [ClienteSocialAuthController::class, 'handleGoogleCallback'])->name('cliente.google.callback');
Route::post('/cliente/logout', [ClienteSocialAuthController::class, 'logout'])->name('cliente.logout');
Route::view('/cliente/mis-pedidos', 'clientes.mis-pedidos');

Route::middleware(['auth:admin', 'admin.activo'])->group(function () {
    Route::get('/dashboard', [InicioController::class, 'inicio'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/administrador/citas', [AdministradorController::class, 'citas'])->middleware('permiso.admin:citas')->name('administrador.citas');
    Route::get('/administrador/valuador', [AdministradorController::class, 'valuador'])->middleware('permiso.admin:valuador')->name('administrador.valuador');

    Route::middleware('permiso.admin:administracion')->group(function () {
        Route::get('/administrador', [AdministradorController::class, 'listado']);
        Route::get('/administrador/formulario', [AdministradorController::class, 'inicio']);
        Route::post('/administrador', [AdministradorController::class, 'guardar']);
        Route::get('/administrador/{id}', [AdministradorController::class, 'ver']);
        Route::get('/administrador/{id}/editar', [AdministradorController::class, 'edit']);
        Route::put('/administrador/{id}', [AdministradorController::class, 'update']);
        Route::get('/administrador/{id}/eliminar', [AdministradorController::class, 'eliminar'])->middleware('permiso.admin:master');
        Route::delete('/administrador/{id}', [AdministradorController::class, 'destroy'])->middleware('permiso.admin:master');

        Route::get('/cliente', [ClienteController::class, 'listado']);
        Route::get('/cliente/formulario', [ClienteController::class, 'inicio']);
        Route::get('/cliente/{id}', [ClienteController::class, 'ver']);
        Route::get('/cliente/{id}/editar', [ClienteController::class, 'edit']);
        Route::put('/cliente/{id}', [ClienteController::class, 'update']);
        Route::get('/cliente/{id}/eliminar', [ClienteController::class, 'eliminar'])->middleware('permiso.admin:master');
        Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->middleware('permiso.admin:master');

        Route::get('/proveedor', [ProveedorController::class, 'listado']);
        Route::get('/proveedor/formulario', [ProveedorController::class, 'inicio']);
        Route::post('/proveedor', [ProveedorController::class, 'guardar']);
        Route::get('/proveedor/{id}', [ProveedorController::class, 'ver']);
        Route::get('/proveedor/{id}/editar', [ProveedorController::class, 'edit']);
        Route::put('/proveedor/{id}', [ProveedorController::class, 'update']);
        Route::get('/proveedor/{id}/eliminar', [ProveedorController::class, 'eliminar'])->middleware('permiso.admin:master');
        Route::delete('/proveedor/{id}', [ProveedorController::class, 'destroy'])->middleware('permiso.admin:master');
    });

    Route::get('/pedido', [PedidoController::class, 'listado'])->middleware('permiso.admin:ventas');
    Route::get('/pedido/formulario', [PedidoController::class, 'inicio'])->middleware('permiso.admin:ventas,ventas_registro');
    Route::post('/pedido', [PedidoController::class, 'guardar'])->middleware('permiso.admin:ventas,ventas_registro');

    Route::get('/producto', [ProductoController::class, 'listado'])->middleware('permiso.admin:inventario,inventario_ver');
    Route::get('/producto/formulario', [ProductoController::class, 'inicio'])->middleware('permiso.admin:inventario');
    Route::post('/producto', [ProductoController::class, 'guardar'])->middleware('permiso.admin:inventario');
    Route::get('/producto/{id}', [ProductoController::class, 'ver'])->middleware('permiso.admin:inventario,inventario_ver');
    Route::get('/producto/{id}/editar', [ProductoController::class, 'edit'])->middleware('permiso.admin:inventario');
    Route::put('/producto/{id}', [ProductoController::class, 'update'])->middleware('permiso.admin:inventario');
    Route::get('/producto/{id}/eliminar', [ProductoController::class, 'eliminar'])->middleware('permiso.admin:master');
    Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->middleware('permiso.admin:master');

    Route::get('/pagos', [PagoController::class, 'listado'])->middleware('permiso.admin:pagos');
    Route::get('/pagos/formulario', [PagoController::class, 'inicio'])->middleware('permiso.admin:pagos');
    Route::post('/pagos', [PagoController::class, 'guardar'])->middleware('permiso.admin:pagos');

    Route::view('/catalogos', 'catalogos.inicio')->middleware('permiso.admin:catalogos');
    Route::get('/marcas', [MarcaController::class, 'listado'])->middleware('permiso.admin:catalogos');
    Route::get('/marcas/formulario', [MarcaController::class, 'inicio'])->middleware('permiso.admin:catalogos');
    Route::post('/marcas', [MarcaController::class, 'guardar'])->middleware('permiso.admin:catalogos');
    Route::get('/marcas/{id}', [MarcaController::class, 'ver'])->middleware('permiso.admin:catalogos');
    Route::get('/marcas/{id}/editar', [MarcaController::class, 'edit'])->middleware('permiso.admin:catalogos');
    Route::put('/marcas/{id}', [MarcaController::class, 'update'])->middleware('permiso.admin:catalogos');
    Route::get('/marcas/{id}/eliminar', [MarcaController::class, 'eliminar'])->middleware('permiso.admin:master');
    Route::delete('/marcas/{id}', [MarcaController::class, 'destroy'])->middleware('permiso.admin:master');

    Route::get('/modelos', [ModeloController::class, 'listado'])->middleware('permiso.admin:catalogos');
    Route::get('/modelos/formulario', [ModeloController::class, 'inicio'])->middleware('permiso.admin:catalogos');
    Route::post('/modelos', [ModeloController::class, 'guardar'])->middleware('permiso.admin:catalogos');
    Route::get('/modelos/{id}', [ModeloController::class, 'ver'])->middleware('permiso.admin:catalogos');
    Route::get('/modelos/{id}/editar', [ModeloController::class, 'edit'])->middleware('permiso.admin:catalogos');
    Route::put('/modelos/{id}', [ModeloController::class, 'update'])->middleware('permiso.admin:catalogos');
    Route::get('/modelos/{id}/eliminar', [ModeloController::class, 'eliminar'])->middleware('permiso.admin:master');
    Route::delete('/modelos/{id}', [ModeloController::class, 'destroy'])->middleware('permiso.admin:master');

    Route::get('/colores', [ColorController::class, 'listado'])->middleware('permiso.admin:catalogos');
    Route::get('/colores/formulario', [ColorController::class, 'inicio'])->middleware('permiso.admin:catalogos');
    Route::post('/colores', [ColorController::class, 'guardar'])->middleware('permiso.admin:catalogos');
    Route::get('/colores/{id}', [ColorController::class, 'ver'])->middleware('permiso.admin:catalogos');
    Route::get('/colores/{id}/editar', [ColorController::class, 'edit'])->middleware('permiso.admin:catalogos');
    Route::put('/colores/{id}', [ColorController::class, 'update'])->middleware('permiso.admin:catalogos');
    Route::get('/colores/{id}/eliminar', [ColorController::class, 'eliminar'])->middleware('permiso.admin:master');
    Route::delete('/colores/{id}', [ColorController::class, 'destroy'])->middleware('permiso.admin:master');

    Route::get('/tipos', [TipoController::class, 'listado'])->middleware('permiso.admin:catalogos');
    Route::get('/tipos/formulario', [TipoController::class, 'inicio'])->middleware('permiso.admin:catalogos');
    Route::post('/tipos', [TipoController::class, 'guardar'])->middleware('permiso.admin:catalogos');

    Route::get('/productos-pedido', [ProductoPedidoController::class, 'listado'])->middleware('permiso.admin:ventas');
    Route::get('/productos-pedido/formulario', [ProductoPedidoController::class, 'inicio'])->middleware('permiso.admin:ventas,ventas_registro');
    Route::post('/productos-pedido', [ProductoPedidoController::class, 'guardar'])->middleware('permiso.admin:ventas,ventas_registro');
});

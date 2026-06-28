<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;

Route::post('/valuar-vehiculo', [AdministradorController::class, 'valuarVehiculo']);
Route::post('/validar-licencia', [ClienteController::class, 'validarLicencia']);

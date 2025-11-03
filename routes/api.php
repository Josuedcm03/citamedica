<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoCitaController;

Route::apiResource('empleados', EmpleadoController::class);
Route::apiResource('pacientes', PacienteController::class);
Route::apiResource('citas', CitaController::class);
Route::apiResource('pagos-cita', PagoCitaController::class)
    ->parameters(['pagos-cita' => 'pago_cita']);

// Acciones especiales de citas
Route::post('citas/{cita}/confirmar', [CitaController::class, 'confirmar']);
Route::post('citas/{cita}/cancelar', [CitaController::class, 'cancelar']);
Route::post('citas/{cita}/atendida', [CitaController::class, 'marcarAtendida']);
Route::post('citas/{cita}/publicar-resultado', [CitaController::class, 'publicarResultado']);

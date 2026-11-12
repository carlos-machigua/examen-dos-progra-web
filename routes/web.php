<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');

Route::middleware('auth')->group(function () 
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('medicamentos', MedicamentosController::class)->except(['show']);
    Route::resource('proveedores', ProveedorController::class)
        ->parameters(['proveedores' => 'proveedor'])->except(['show']);

    Route::resource('empleados', EmpleadoController::class)->except(['show']);
    }
);

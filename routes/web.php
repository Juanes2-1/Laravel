<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Registro de usuarios
Route::get('/registro', [UsuarioController::class, 'showRegistroForm'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'store'])->name('registro.store');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout (requiere autenticación)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (solo accesibles si el usuario ha iniciado sesión)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ Ruta para mostrar el formulario de recarga
    Route::get('/recargar', [UsuarioController::class, 'showRecargaForm'])->name('recargar.form');
    
    // ✅ Ruta para procesar la recarga
    Route::post('/recargar', [UsuarioController::class, 'recargar'])->name('recargar.store');
});

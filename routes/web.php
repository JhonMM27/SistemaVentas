<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layout.app');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// });
// Route::get('/login', function () {
//     return view('login.index');
// });


// Route::resource('categorias', CategoriaController::class);
// Route::resource('productos', ProductoController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/', function(){
    return view('login.index');
});


Route::middleware(['auth'])->group(function () {
    // Gestión de usuarios
    // Route::resource('user', Us::class);

    // Gestión de categorías
    Route::resource('categorias', CategoriaController::class)->middleware('permission:categoria-activar');
    Route::resource('usuarios', userController::class)->middleware('permission:usuario-activar');
    Route::resource('ventas', VentaController::class);//->middleware('permission:venta-activar');
    
//     Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
// Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
// Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
// Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    // ->name('reporte');



    Route::resource('productos',ProductoController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard',function(){
        return view('dashboard.index');
    })->name('dashboard');
});
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
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
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    // Gestión de usuarios
    // Route::resource('user', Us::class);

    // Gestión de categorías
    Route::resource('categorias', CategoriaController::class)->middleware('can:categoria-activar');


    // ->name('reporte');



    Route::resource('productos',ProductoController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard',function(){
        return view('dashboard.index');
    })->name('dashboard');
});
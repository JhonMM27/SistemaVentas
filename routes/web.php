<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.app');
});
Route::get('/dashboard', function () {
    return view('dashboard.index');
});


Route::resource('categorias', CategoriaController::class);

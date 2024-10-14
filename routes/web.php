<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('plantilla');
});

Route::resource('tipos', App\Http\Controllers\TiposController::class);
Route::resource('mascotas', App\Http\Controllers\MascotasController::class);
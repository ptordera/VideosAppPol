<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;

Route::get('/', function () {
    return view('welcome');
})->name('home'); // Aquí agregamos el nombre "home"

Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');

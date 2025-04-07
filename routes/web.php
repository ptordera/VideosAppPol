<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;

Route::get('/', function () {
    return view('welcome');
})->name('home'); // Aquí agregamos el nombre "home"

Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/video/{id}', [VideosController::class, 'show'])->name('videos.show');

Route::middleware(['auth', 'can:manage-videos'])->group(function () {
    Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.manage.index');
    Route::get('/videos/manage/create', [VideosManageController::class, 'create'])->name('videos.manage.create');
    Route::post('/videos/manage', [VideosManageController::class, 'store'])->name('videos.manage.store');
    Route::get('/videos/manage/{id}/edit', [VideosManageController::class, 'edit'])->name('videos.manage.edit');
    Route::put('/videos/manage/{id}', [VideosManageController::class, 'update'])->name('videos.manage.update');
    Route::delete('/videos/manage/{id}', [VideosManageController::class, 'destroy'])->name('videos.manage.destroy');
});

Route::middleware(['auth', 'can:manage-users'])->prefix('users/manage')->group(function () {
    Route::get('/', [UsersManageController::class, 'index'])->name('users.manage.index');
    Route::get('/create', [UsersManageController::class, 'create'])->name('users.manage.create');
    Route::post('/', [UsersManageController::class, 'store'])->name('users.manage.store');
    Route::get('/{user}/edit', [UsersManageController::class, 'edit'])->name('users.manage.edit');
    Route::put('/{user}', [UsersManageController::class, 'update'])->name('users.manage.update');
    Route::delete('/{user}', [UsersManageController::class, 'destroy'])->name('users.manage.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
});

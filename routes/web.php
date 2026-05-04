<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // User Routes (ADMIN)
    Route::get('/users', [UserController::class, 'index'] )->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'] )->name('user.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'] )->name('user.edit');
    Route::post('/users', [UserController::class, 'store'] )->name('user.store');
    Route::patch('/users/{user}', [UserController::class, 'update'] )->name('user.update');
    Route::post('/users/{user}', [UserController::class, 'destroy'] )->name('user.destroy');


});

require __DIR__.'/settings.php';

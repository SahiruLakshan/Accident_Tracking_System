<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccidentController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::get('/', [AccidentController::class, 'home'])->name('dashboard');

    Route::get('/users', [AccidentController::class, 'user'])->name('admin.info');

    Route::get('/accidents', [AccidentController::class, 'getdata'])->name('admin.getdata');
    Route::get('/map', [AccidentController::class, 'map'])->name('admin.map');
    Route::get('/info', [AccidentController::class, 'info'])->name('admin.info');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

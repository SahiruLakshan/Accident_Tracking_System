<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccidentController;

Route::get('/', [AccidentController::class,'home'])->name('admin.home');

Route::get('/users', function () {
    return view('Admin.profile');
});

Route::get('/accidents', [AccidentController::class,'getdata'])->name('admin.getdata');
Route::get('/map', [AccidentController::class,'map'])->name('admin.map');
Route::get('/info', [AccidentController::class,'info'])->name('admin.info');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

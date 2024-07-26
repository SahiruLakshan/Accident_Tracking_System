<?php

use App\Http\Controllers\AccidentController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AccidentController::class,'home'])->name('admin.home');

Route::get('/users', function () {
    return view('Admin.profile');
});

Route::get('/accidents', [AccidentController::class,'getdata'])->name('admin.getdata');
Route::get('/map', [AccidentController::class,'map'])->name('admin.map');
Route::get('/info', [AccidentController::class,'info'])->name('admin.info');
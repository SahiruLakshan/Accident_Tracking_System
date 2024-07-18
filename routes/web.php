<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Admin.home');
});

Route::get('/users', function () {
    return view('Admin.profile');
});

Route::get('/accidents', function () {
    return view('Admin.accidents');
});

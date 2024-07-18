<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Admin.home');
});

Route::get('/profile', function () {
    return view('Admin.profile');
});

Route::get('/accidents', function () {
    return view('Admin.accidents');
});

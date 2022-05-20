<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lang/{lang}', [App\Http\Controllers\HomeController::class, 'changeLang'])
    ->name('changeLang');

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lang/{lang}', [App\Http\Controllers\HomeController::class, 'changeLang'])
    ->name('changeLang');

Route::resource('task_statuses', App\Http\Controllers\TaskStatusController::class);
Route::resource('tasks', App\Http\Controllers\TaskController::class);
Route::resource('labels', App\Http\Controllers\LabelController::class);

Route::get('login/test', [App\Http\Controllers\Auth\LoginController::class, 'testUser'])
    ->name('login.test');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['can:view,user', 'auth'])->group(function () {
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
});
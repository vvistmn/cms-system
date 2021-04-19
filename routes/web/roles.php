<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::patch('roles/{role}/update', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
});
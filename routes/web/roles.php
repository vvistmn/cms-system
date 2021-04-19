<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::patch('roles/{role}/update', [RoleController::class, 'update'])->name('role.update');

    Route::put('/roles/{role}/attach', [RoleController::class, 'attach'])->name('role.permission.attach');
    Route::delete('/roles/{role}/attach', [RoleController::class, 'detach'])->name('role.permission.detach');

    Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
});
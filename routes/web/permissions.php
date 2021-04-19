<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::patch('/permissions/{permission}/update', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/{permission}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
});
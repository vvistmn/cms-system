<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;




Route::middleware('auth')->group(function () {   
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');
});
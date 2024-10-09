<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.layout');
});
Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::delete('/posts/{post}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force-delete');
Route::resource('/posts', PostController::class);

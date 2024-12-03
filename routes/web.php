<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Author\BookController;
use App\Http\Controllers\Author\GenreController;
use App\Http\Controllers\Author\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthCOntroller::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'authorMiddleware', 'prefix' => 'author'], function () {
    Route::get('index', [AuthorController::class, 'index'])->name('author.dashboard');

    Route::get('book/index', [BookController::class, 'index'])->name('book.index');
    Route::get('book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('book', [BookController::class, 'store'])->name('book.store');
    Route::get('book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('book/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('book/{book}', [BookController::class, 'destroy'])->name('book.destroy');

    Route::get('penerbit/index', [PenerbitController::class, 'index'])->name('penerbit.index');
    Route::get('penerbit/create', [PenerbitController::class, 'create'])->name('penerbit.create');
    Route::post('penerbit', [PenerbitController::class, 'store'])->name('penerbit.store');
    Route::get('penerbit/{penerbit}/edit', [PenerbitController::class, 'edit'])->name('penerbit.edit');
    Route::put('penerbit/{penerbit}', [PenerbitController::class, 'update'])->name('penerbit.update');
    Route::delete('penerbit/{penerbit}', [PenerbitController::class, 'destroy'])->name('penerbit.destroy');


    Route::get('genre/index', [GenreController::class, 'index'])->name('genre.index');
    Route::get('genre/create', [GenreController::class, 'create'])->name('genre.create');
    Route::post('genre', [GenreController::class, 'store'])->name('genre.store');
});

Route::group(['midlleware' => 'adminMiddleware', 'prefix' => 'admin'], function () {
    Route::get('index', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('index/approveAuthors/{id}', [AdminController::class, 'approveAuthors'])->name('index.approve');
});

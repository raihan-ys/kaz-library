<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;

// Home.
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);

// Books.
Route::resource('/buku', BookController::class);
Route::get('/buku', [BookController::class, 'index'])->name('buku');
Route::get('/buku/{id}/show', [BookController::class, 'show'])->name('buku.show');
Route::post('/buku/store', [BookController::class, 'store'])->name('buku.store');
Route::get('buku/{id}/edit', [BookController::class, 'edit'])->name('buku.edit');
Route::put('buku/{id}/update', [BookController::class, 'update'])->name('buku.update');
Route::delete('buku/{id}/destroy', [BookController::class, 'destroy'])->name('buku.destroy');

// Categories.
Route::resource('/kategori', CategoryController::class);
Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori');
Route::delete('kategori/{id}/destroy',  [CategoryController::class, 'destroy'])->name('kategori.destroy');

// Publishers.
Route::resource('/penerbit', PublisherController::class);
Route::get('/penerbit', [PublisherController::class, 'index'])->name('penerbit');
Route::delete('penerbit/{id}/destroy',  [PublisherController::class, 'destroy'])->name('penerbit.destroy');

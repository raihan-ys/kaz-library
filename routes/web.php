<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

// Home.
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);

// Books.
Route::get('/buku', [BookController::class, 'index'])->name('buku');
Route::get('/buku/{id}/show', [BookController::class, 'show'])->name('buku.show');
Route::post('/buku/store', [BookController::class, 'store'])->name('buku.store');
Route::get('/buku/{id}/edit', [BookController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}/update', [BookController::class, 'update'])->name('buku.update');
Route::delete('/buku/{id}/destroy', [BookController::class, 'destroy'])->name('buku.destroy');

// Categories.
Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori');
Route::delete('/kategori/{id}/destroy',  [CategoryController::class, 'destroy'])->name('kategori.destroy');

// Publishers.
Route::get('/penerbit', [PublisherController::class, 'index'])->name('penerbit');
Route::delete('/penerbit/{id}/destroy',  [PublisherController::class, 'destroy'])->name('penerbit.destroy');

// Members.
Route::get('/anggota', [MemberController::class, 'index'])->name('anggota');
Route::get('/anggota/{id}/show', [MemberController::class, 'show'])->name('anggota.show');
Route::post('/anggota/store', [MemberController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{id}/edit', [MemberController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{id}/update', [MemberController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{id}/destroy', [MemberController::class, 'destroy'])->name('anggota.destroy');

// Borrowings.
Route::get('/penyewaan', [BorrowingController::class, 'index'])->name('penyewaan');
Route::get('/penyewaan/{id}/show', [BorrowingController::class, 'show'])->name('penyewaan.show');
Route::post('/penyewaan/store', [BorrowingController::class, 'store'])->name('penyewaan.store');
Route::get('/penyewaan/{id}/edit', [BorrowingController::class, 'edit'])->name('penyewaan.edit');
Route::put('/penyewaan/{id}/update', [BorrowingController::class, 'update'])->name('penyewaan.update');
Route::delete('/penyewaan/{id}/destroy', [BorrowingController::class, 'destroy'])->name('penyewaan.destroy');

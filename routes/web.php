<?php
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// 404 handler.
Route::fallback(function() {
	return view('pages.errors.page_not_found');
});

// Book.
Route::resource('buku', BookController::class);
Route::delete('buku/{id}/destroy',  [BookController::class, 'destroy']);

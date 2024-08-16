<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

// Home.
Route::get('', HomeController::class);
Route::get('home', HomeController::class);

// Book.
Route::get('buku', BookController::class);
Route::get('buku/{id}', [BookController::class, 'show']);
Route::post('buku', [BookController::class, 'store']);
Route::put('buku/{id}', [BookController::class, 'update']);
Route::delete('buku/{id}/destroy', 'BookController@destroy');

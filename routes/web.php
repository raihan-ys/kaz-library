<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

// Home.
Route::get('/', [HomeController::class, 'index']);
Route::resource('home', HomeController::class);

// Book.
Route::resource('buku', BookController::class);
Route::delete('buku/{id}/destroy', 'BookController@destroy');

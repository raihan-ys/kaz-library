<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SettingController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Unused routes.
Auth::routes(['register' => false, 'reset' => false]);

// Home.
Route::resource('/', HomeController::class)->name('index', 'home');
Route::resource('/home', HomeController::class)->name('index', 'home');

// Dashboard.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Users.
Route::resource('/user', UserController::class)->name('index', 'user')->middleware(['auth', 'role:admin']);

// Books.
Route::resource('/buku', BookController::class)->name('index', 'buku')->middleware('auth');

// Categories.
Route::resource('/kategori', CategoryController::class)->name('index', 'kategori')->middleware('auth');

// Publishers.
Route::resource('/penerbit', PublisherController::class)->name('index', 'penerbit')->middleware('auth');

// Members.
Route::resource('/anggota', MemberController::class)->name('index', 'anggota')->middleware('auth');

// Borrowings.
Route::resource('/penyewaan', BorrowingController::class)->name('index', 'penyewaan')->middleware('auth');

// Account.
Route::resource('/akun', AccountController::class)->name('index', 'akun')->middleware('auth');

// Settings.
Route::resource('/aplikasi', SettingController::class)->name('index', 'aplikasi')->middleware(['auth', 'role:admin']);

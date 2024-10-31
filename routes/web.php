<?php
use App\Http\Controllers\{
	AccountController,
	BorrowingController,
	BookController,
	CategoryController,
	DashboardController,
	HomeController,
	MemberController,
	PublisherController,
	SettingController,
	UserController
};

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
Route::get('/akun/{id}', [AccountController::class, 'index'])->name('akun')->middleware('auth');
Route::get('/akun/{id}/edit', [AccountController::class, 'edit'])->name('akun.edit')->middleware('auth');
Route::put('/akun/{id}/update', [AccountController::class, 'update'])->name('akun.update')->middleware('auth');
Route::get('/akun/{id}/edit-password', [AccountController::class, 'editPassword'])->name('akun.edit-password')->middleware('auth');
Route::put('/akun/{id}/update-password', [AccountController::class, 'updatePassword'])->name('akun.update-password')->middleware('auth');

// Settings.
Route::resource('/aplikasi', SettingController::class)->name('index', 'aplikasi')->middleware(['auth', 'role:admin']);

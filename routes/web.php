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

// Home routes.
Route::resource('/', HomeController::class)->name('index', 'home');
Route::resource('home', HomeController::class)->name('index', 'home');

// Protect the routes with auth middleware.
Route::middleware('auth')->group(function () {
	// Dashboard routes.
	Route::prefix('dashboard')->group(function () {
		Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

		// JSON data routes for the dashboard.
		Route::get('/data/books-count', [DashboardController::class, 'getBooksCountData'])->name('dashboard.data.books_count');
		Route::get('/data/members-count', [DashboardController::class, 'getMembersCountData'])->name('dashboard.data.members_count');
		Route::get('/data/books-by-category', [DashboardController::class, 'getBooksByCategory'])->name('dashboard.data.books_by_category');
		Route::get('/data/popular-categories', [DashboardController::class, 'getPopularCategories'])->name('dashboard.data.popular_categories');
		Route::get('/dashboard/data/books-status', [DashboardController::class, 'getBooksStatus'])->name('dashboard.data.books_status');
		Route::get('/data/popular-books', [DashboardController::class, 'getPopularBooks'])->name('dashboard.data.get_popular_books');
		Route::get('/data/books-by-month', [DashboardController::class, 'getBooksByMonthData'])->name('dashboard.data.books_by_month');
		Route::get('/data/borrowings-by-category', [DashboardController::class, 'getBorrowingsByCategory'])->name('dashboard.data.borrowings_by_category');
		Route::get('/data/members-by-type', [DashboardController::class, 'getMembersByType'])->name('dashboard.data.members_by_type');
		Route::get('/data/latest-borrowings', [DashboardController::class, 'getLatestBorrowings'])->name('dashboard.data.latest_borrowings');
		Route::get('/data/books-returned-late', [DashboardController::class, 'getBooksReturnedLate'])->name('dashboard.data.books_returned_late');
	});

	// Users routes.
	Route::resource('user', UserController::class)->name('index', 'user')->middleware(['auth', 'role:admin']);

	// Books routes including soft deletes.
	Route::prefix('buku')->group(function () {
		Route::get('trashed', [BookController::class, 'trashed'])->name('buku.trashed')->middleware('auth');
		Route::post('{id}/restore', [BookController::class, 'restore'])->name('buku.restore')->middleware('auth');
		Route::delete('{id}/force-delete', [BookController::class, 'forceDelete'])->name('buku.force-delete')->middleware('auth');
	});
	Route::resource('buku', BookController::class)->name('index', 'buku')->middleware('auth');

	// Categories routes including soft deletes.
	Route::prefix('kategori')->group(function () {
		Route::get('trashed', [CategoryController::class, 'trashed'])->name('kategori.trashed')->middleware('auth');
		Route::post('{id}/restore', [CategoryController::class, 'restore'])->name('kategori.restore')->middleware('auth');
		Route::delete('{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('kategori.force-delete')->middleware('auth');
	});
	Route::resource('kategori', CategoryController::class)->name('index', 'kategori')->middleware('auth');

	// Publishers routes including soft deletes.
	Route::prefix('penerbit')->group(function () {
		Route::get('trashed', [PublisherController::class, 'trashed'])->name('penerbit.trashed')->middleware('auth');
		Route::post('{id}/restore', [PublisherController::class, 'restore'])->name('penerbit.restore')->middleware('auth');
		Route::delete('{id}/force-delete', [PublisherController::class, 'forceDelete'])->name('penerbit.force-delete')->middleware('auth');
	});
	Route::resource('penerbit', PublisherController::class)->name('index', 'penerbit')->middleware('auth');

	// Members routes including soft deletes.
	Route::prefix('anggota')->group(function () {
		Route::get('trashed', [MemberController::class, 'trashed'])->name('anggota.trashed')->middleware('auth');
		Route::post('{id}/restore', [MemberController::class, 'restore'])->name('anggota.restore')->middleware('auth');
		Route::delete('{id}/force-delete', [MemberController::class, 'forceDelete'])->name('anggota.force-delete')->middleware('auth');
	});
	Route::resource('anggota', MemberController::class)->name('index', 'anggota')->middleware('auth');

	// Borrowings routes including soft deletes.
	Route::prefix('penyewaan')->group(function () {
		Route::get('trashed', [BorrowingController::class, 'trashed'])->name('penyewaan.trashed')->middleware('auth');
		Route::post('{id}/restore', [BorrowingController::class, 'restore'])->name('penyewaan.restore')->middleware('auth');
		Route::delete('{id}/force-delete', [BorrowingController::class, 'forceDelete'])->name('penyewaan.force-delete')->middleware('auth');
	});
	Route::resource('penyewaan', BorrowingController::class)->name('index', 'penyewaan')->middleware('auth');

	// Account routes.
	Route::prefix('akun')->group(function() {
		Route::get('{id}', [AccountController::class, 'index'])->name('akun')->middleware('auth');
		Route::get('{id}/edit', [AccountController::class, 'edit'])->name('akun.edit')->middleware('auth');
		Route::put('{id}/update', [AccountController::class, 'update'])->name('akun.update')->middleware('auth');
		Route::get('{id}/edit-password', [AccountController::class, 'editPassword'])->name('akun.edit-password')->middleware('auth');
		Route::put('{id}/update-password', [AccountController::class, 'updatePassword'])->name('akun.update-password')->middleware('auth');
	});

	// Settings routes.
	Route::resource('aplikasi', SettingController::class)->name('index', 'aplikasi')->middleware(['auth', 'role:admin']);
	Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
	Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

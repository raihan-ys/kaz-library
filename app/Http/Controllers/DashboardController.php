<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;

use Carbon\Carbon;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	/**
	 * Show the dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		return view('pages.dashboard.index');
	}

	public function getBooksCountData()
	{
		// Get the total number of books.
		$booksCount = DB::table('books')->count();

		// Get the total number of books borrowed.
		$borrowedBooksCount = Borrowing::count();

		// Get the total number of books returned late.
		$booksReturnedLateCount = Borrowing::where('return_date', '>', DB::raw('DATE_ADD(borrow_date, INTERVAL 7 DAY)'))
			->count();

		return response()->json([
			'booksCount' => $booksCount,
			'borrowedBooksCount' => $borrowedBooksCount,
			'booksReturnedLateCount' => $booksReturnedLateCount
		]);
	}

	public function getMembersCountData()
	{
		// Get the total number of members.
		$membersCount = DB::table('members')->count();

		return response()->json([
			'membersCount' => $membersCount
		]);
	}

	public function getBooksByCategory()
	{
		// Get books counts grouped by category.
		$booksByCategory = DB::table('books')
			->join('categories', 'categories.id', '=', 'books.category_id')
			->select('categories.name as ctg_name', DB::raw('count(books.id) as count')) // Raw query.
			->groupBy('categories.name')
			->get();

		return response()->json([
			'booksByCategory' => $booksByCategory
		]);
	}

	public function getPopularCategories()
	{
		// Get the most popular categories.
		$popularCategories = DB::table('borrowings')
			->join('books', 'books.id', '=', 'borrowings.book_id')
			->join('categories', 'categories.id', '=', 'books.category_id')
			->select('categories.name as category_name', DB::raw('count(borrowings.id) as count'))
			->groupBy('categories.id', 'categories.name')
			->orderBy('count', 'desc')
			->limit(3)
			->pluck('count', 'category_name')
			->toArray();
	
		return response()->json([
			'popularCategoriesKeys' => array_keys($popularCategories),
			'popularCategoriesValues' => array_values($popularCategories)
		]);
	}

	public function getBooksStatus()
	{
		// Get the total number of books.
    $booksCount = DB::table('books')->sum('stock');

    // Get the total number of books borrowed.
    $borrowedBooksCount = Borrowing::count();

		// Available books count.
		$availableBooksCount = $booksCount - $borrowedBooksCount;

    return response()->json([
			'availableBooksCount' => $availableBooksCount,
			'borrowedBooksCount' => $borrowedBooksCount
    ]);
	}

	public function getPopularBooks()
	{
		// Get the most popular books.
		$popularBooks = DB::table('borrowings')
			->join('books', 'books.id', '=', 'borrowings.book_id')
			->select('books.title as book_title', DB::raw('count(borrowings.id) as count'))
			->groupBy('books.id', 'books.title')
			->orderBy('count', 'desc')
			->limit(5)
			->pluck('count', 'book_title')
			->toArray();

		return response()->json([
			'popularBooksKeys' => array_keys($popularBooks),
			'popularBooksValues' => array_values($popularBooks)
		]);
	}

	public function getBooksByMonthData()
	{
		// Get all borrowings for the year 2025.
		$borrowings = Borrowing::whereYear('borrow_date', 2025)->get()->groupBy(function($date) {
			// Group by months.
			return Carbon::parse($date->borrow_date)->format('m');
		});

		$borrowingsCount = [];
		$borrowMonths = [];

		foreach ($borrowings as $key => $value) {
			// Count the number of borrowings for each month.
			$borrowingsCount[(int)$key] = count($value);
			
			// Get the month name in Indonesian.
			$borrowMonths[(int)$key] = Carbon::create()->month((int)$key)->locale('id')->isoFormat('MMM');
		}

		// Sort borrowing by months.
		ksort($borrowingsCount);
		ksort($borrowMonths);
		
		return response()->json([
			'borrowings' => array_values($borrowingsCount),
			'months' => array_values($borrowMonths),
		]);
	}

	public function getBorrowingsByCategory()
	{
		// Get borrowing counts grouped by book category.
		$borrowingsCount = DB::table('borrowings')
			->join('books', 'books.id', '=', 'borrowings.book_id')
			->join('categories', 'categories.id', '=', 'books.category_id')
			->select('categories.name as category_name', DB::raw('count(borrowings.id) as count')) // Raw query.
			->groupBy('categories.id', 'categories.name')
			->pluck('count', 'category_name')
			->toArray();	

		return response()->json([
			'borrowingsKeys' => array_keys($borrowingsCount),
			'borrowingsValues' => array_values($borrowingsCount)
		]);
	}

	public function getMembersByType()
	{
		// Get member counts grouped by member type.
		$membersCount = DB::table('members')
			->join('member_types', 'member_types.id', '=', 'members.type_id')
			->select('member_types.name as type_name', DB::raw('count(members.id) as count')) // Raw query.
			->groupBy('member_types.name')
			->get();

		return response()->json([
			'members' => $membersCount
		]);
	}

	public function getLatestBorrowings()
	{
		// Get the latest borrowings.
		$latestBorrowings = Borrowing::with('book', 'member')
			->latest()
			->limit(4)
			->get();

		return response()->json([
			'latestBorrowings' => $latestBorrowings
		]);
	}

	public function getBooksReturnedLate()
	{
		// Get the books returned late.
		$booksReturnedLate = Borrowing::with('book', 'member')
			->where('return_date', '>', DB::raw('DATE_ADD(borrow_date, INTERVAL 7 DAY)'))
			->limit(4)
			->get()
			->map(function ($borrowing) {
					$borrowDate = Carbon::parse($borrowing->borrow_date);
					$returnDate = Carbon::parse($borrowing->return_date);
					$lateDays = (int) abs($returnDate->diffInDays($borrowDate->copy()->addDays(7)));

					$borrowing->late_days = $lateDays;
					$borrowing->late_fee = ($lateDays * 1000);
					return $borrowing;
				});

		return response()->json([
			'booksReturnedLate' => $booksReturnedLate
		]);
	}
}

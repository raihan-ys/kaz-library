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

	public function getBooksByMonthData()
	{
		// Get all borrowings for the year 2024.
		$borrowings = Borrowing::whereYear('borrow_date', 2024)->get()->groupBy(function($date) {
			// Group by months.
			return Carbon::parse($date->borrow_date)->format('m');
		});

		$borrowingsCount = [];
		$borrowMonths = [];

		foreach ($borrowings as $key => $value) {
			// Count the number of borrowings for each month.
			$borrowingsCount[(int)$key] = count($value);
			
			// Get the month name in Indonesian.
			$borrowMonths[(int)$key] = Carbon::create()->month($key)->locale('id')->isoFormat('MMM');
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
}

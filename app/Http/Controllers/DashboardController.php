<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

	public function getBooksByMonthData(Request $request)
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
}

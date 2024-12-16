<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get all books.
        $books = Book::orderBy('published_year', 'DESC')->take(4)->get();

        // Get most borrowed books with 'Borrowing' model.
        $mostBorrowedBooks = Borrowing::select('book_id', DB::raw('count(*) as total_borrowed'))
            ->groupBy('book_id') // Group the borrowings by 'book_id'.
            ->orderBy('total_borrowed', 'DESC')
            ->take(4)
            ->with('book') // Eager load the book relationship (Function in 'Borrowing' model).
            ->get();
        return view('pages.home', compact('books', 'mostBorrowedBooks'));
    }
}

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
        $mostBorrowedBooks = Borrowing::join('books', 'books.id', '=', 'borrowings.book_id')
            ->select('borrowings.book_id', DB::raw('count(*) as total_borrowed', 'books.title as book_title', 'books.author as book_author', 'books.cover_image as book_cover'))
            ->groupBy('borrowings.book_id')
            ->orderBy('total_borrowed', 'DESC')
            ->take(4)
            ->get();
            
        return view('pages.home', compact('books', 'mostBorrowedBooks'));
    }
}

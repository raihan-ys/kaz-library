<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Book;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;

use Carbon\Carbon;

use Illuminate\Routing\Controller;

class BorrowingController extends Controller
{
    // Display all borrowings.
    public function index()
    {   // with('member', 'book')
        $borrowings = Borrowing::join('members', 'members.id', '=', 'borrowings.member_id')
            ->join('books', 'books.id', '=', 'borrowings.book_id')
            ->select('borrowings.*', 'members.full_name', 'books.title as book_title', 'books.cover_image as book_cover')
            ->orderBy('borrow_date', 'DESC')
            ->get();
        $members = Member::orderBy('full_name')->get();
        $books = Book::orderBy('title')->get();
        
        return view('pages.borrowings.index', compact('borrowings', 'members', 'books'));
    }

    // Store a newly created borrowing.
    public function store(StoreBorrowingRequest $request)
    {
        // Input validation.
		$validated = $request->validated();

        // Check the book's stock.
        $book = Book::find($request->book_id);
        if($book->stock > 0) {
            // The book's stock decreased.
            $book->stock -= 1;
            $book->save();
            
            // Create new borrowing with validated data.
            $borrowing = Borrowing::create($validated);
            $id = $borrowing->id;
            
            return redirect()->route('penyewaan.show', $id)->with('success', 'Peminjaman berhasil disimpan!');
        } else {
            // If there's no stock.
            return redirect()->route('penyewaan')->withErrors('Stok buku tidak mencukupi untuk peminjaman!');
        }
    }

    // Display the specified borrowing.
    public function show($id)
    {   
        // Check if the specified borrowing exist.
        $borrowing = Borrowing::findOrFail($id);
        
        // Get specified book.
        $book = Book::findOrFail($borrowing->book_id);

        // Check if return date is later than due date.
        $borrowDate = Carbon::parse($borrowing->borrow_date);
        $dueDate = $borrowDate->copy()->addDays(7);
        $returnDate = $borrowing->return_date ? Carbon::parse($borrowing->return_date) : Carbon::now();
        
        $lateDays = 0;
        $isLate = false;

        // Calculate late days.
        if ($returnDate->gt($dueDate)) {
            $lateDays = (int) abs($returnDate->diffInDays($dueDate));
            $isLate = true;
        }
        $lateFee = $lateDays * 1000;
   
        return view('pages.borrowings.show', compact('borrowing', 'book', 'lateDays', 'isLate', 'lateFee'));
    }

    // Show the form for editing the specified borrowing.
    public function edit($id)
    {
        // Check if the specified borrowing exist.
        $borrowing = Borrowing::findOrFail($id);
        
        $members = Member::orderBy('full_name')->get();
        $books = Book::orderBy('title')->get();

        return view('pages.borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    // Update the specified borrowing.
    public function update(UpdateBorrowingRequest $request, $id)
    {
        // Check if the specified borrowing exist.
        $borrowing = Borrowing::findOrFail($id);

        // Validate the form.
        $validated = $request->validated();
        if($request->status === 'dikembalikan') {
            $request->validate(
                [
                    'return_date' => 'required|date', 
                ], 
                [
                    'return_date.required' => 'Tanggal pengembalian wajib diisi!',
                    'return_date.date' => 'Tanggal pengembalian tidak valid!',
                ]
            );
            // Restoring book stock.
            $book = Book::find($borrowing->book_id);
            $book->stock+= 1;
            $book->save();

            // Check if return date is later than due date.
            $borrowDate = Carbon::parse($borrowing->borrow_date);
            $dueDate = $borrowDate->copy()->addDays(7); // Day limit (seven days).
            $returnDate = Carbon::parse($request->return_date); // Return date.
            $lateDays = max(0, $returnDate->diffInDays($dueDate)); // Ensure lateDays is no negative.

            // Calculate late fee.
            $lateFee = $returnDate->gt($dueDate) ? $lateDays * 1000 : 0;

            $validated['return_date'] = $returnDate;
            $validated['late_fee'] = $lateFee;
        } else {
            $validated['return_date'] = null;
            $validated['late_fee'] = null;
        }

        $borrowing->update($validated);
        
        return redirect()->route('penyewaan.show', $id)->with('success', 'Peminjaman berhasil diperbarui!');
    }

    // Remove the specified borrowing.
    public function destroy($id)
    {
        // Check if the specified borrowing exist.
        $borrowing = Borrowing::findOrFail($id);

        // Restore book stock if the book hasn't returned.
        if($borrowing->status === 'dipinjam') {
            $book = Book::find($borrowing->book_id);
            $book->stock+= 1;
            $book->save();
        }
        
        $borrowing->delete();
        return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil dihapus!');
    }

    // Display soft deleted borrowings.
	public function trashed()
	{
		// Retrieve only soft deleted borrowings.
		$borrowings = Borrowing::onlyTrashed()->join('members', 'members.id', '=', 'borrowings.member_id')
            ->join('books', 'books.id', '=', 'borrowings.book_id')
            ->select('borrowings.*', 'members.full_name', 'books.title as book_title', 'books.cover_image as book_cover')
            ->orderBy('borrow_date', 'DESC')
            ->get();

		return view('pages.borrowings.trashed', compact('borrowings'));
	}

	// Retrieve the soft deleted borrowing.
	public function restore($id)
	{
		// Retrieve the soft deleted borrowing by its ID.
		$borrowing = Borrowing::withTrashed()->findOrFail($id);

		$borrowing->restore();
        
        // Check the book's stock.
        if($borrowing->status === 'dipinjam') {
            // The book's stock decreased.
            $book = Book::findOrFail($borrowing->book_id);
            $book->stock -= 1;
            $book->save();
        }
		
		return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil dipulihkan!');
	}
	
    // Force delete the specified borrowing.
	public function forceDelete($id)
	{
		// Retrieve the soft deleted borrowing by its ID.
		$borrowing = Borrowing::withTrashed()->findOrFail($id);
	
		$borrowing->forceDelete();

		return redirect()->route('penyewaan.trashed')->with('success', 'Peminjaman berhasil dihapus secara permanen!');
	}
}

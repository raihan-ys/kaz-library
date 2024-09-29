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
    {
        $data['borrowings'] = Borrowing::with('member', 'book')->get();
        $data['members'] = Member::all();
        $data['books'] = Book::all();
        $data['title'] = 'Daftar Penyewaan Buku';
        return view('pages.borrowings.index', $data);
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
            $book->stock--;
            $book->save();
            
            // Create new borrowing with validated data.
            Borrowing::create($validated);
            return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil disimpan!');
        } else {
            // If there's no stock.
            return redirect()->route('penyewaan')->withErrors('Stok buku tidak mencukupi untuk peminjaman!');
        }
    }

    // Display the specified borrowing.
    public function show($id)
    {   
        // Check if the specified book exist.
        $borrowing = Borrowing::findOrFail($id);

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
   
        $title = 'Detail Penyewaan';
        return view('pages.borrowings.show', compact('title', 'borrowing', 'lateDays', 'isLate', 'lateFee'));
    }

    // Show the form for editing the specified borrowing.
    public function edit($id)
    {
        // Check if the specified book exist.
        $borrowing = Borrowing::findOrFail($id);
        
        $members = Member::all();
        $books = Book::all();

        $title = 'Edit Penyewaan';
        return view('pages.borrowings.edit', compact('borrowing', 'members', 'books', 'title'));
    }

    // Update the specified borrowing.
    public function update(UpdateBorrowingRequest $request, $id)
    {
        // Check if the specified book exist.
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
            $book->stock++;
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
        return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    // Remove the specified borrowing.
    public function destroy($id)
    {
        // Check if the specified book exist.
        $borrowing = Borrowing::findOrFail($id);
        
        $borrowing->delete();
        return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Book;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;
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

        $book = Book::find($request->book_id);

        // Check the book's stock.
        if($book->stock > 0) {
            // The book's stock decreased.
            $book->stock -= 1;
            $book->save();
            
            // Create new book with validated data.
            Borrowing::create($validated);

            return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil disimpan!');
        } else {
            // If there's no stock.
            return redirect()->route('penyewaan')->withErrors('Stok buku tidak mencukupi untuk peminjaman!');
        }
    }

    // Display the specified borrowing.
    public function show($id)
    {   $data['borrowing'] = Borrowing::findOrFail($id);
        $data['title'] = 'Detail Penyewaan';
        return view('pages.borrowings.show', $data);
    }

    // Show the form for editing the specified borrowing.
    public function edit($id)
    {
        // Check if the specified book exist.
        $data['borrowing'] = Borrowing::findOrFail($id);
        $data['members'] = Member::all();
        $data['books'] = Book::all();
        $data['title'] = 'Edit Penyewaan';
        return view('pages.borrowings.edit', $data);
    }

    // Update the specified borrowing.
    public function update(UpdateBorrowingRequest $request, $id)
    {
        // Check if the specified book exist.
        $borrowing = Borrowing::findOrFail($id);
        $request->validated();

        if($request->status === 'dikembalikan') {
            $request->validate(
            [
                'return_date' => 'required|date', 
            ], 
            [
                'return_date.required' => 'Tanggal pengembalian wajib diisi!',
                'return_date.date' => 'Tanggal pengembalian tidak valid!',
            ]);
            // Restoring book stock.
            $book = Book::find($borrowing->book_id);
            $book->stock += 1;
            $book->save();
        }
        $borrowing->update($request->all());
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

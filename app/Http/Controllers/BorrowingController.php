<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Book;
use App\Http\Requests\StoreBorrowingRequest;
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

		// Create new book with validated data.
		Borrowing::create($validated);

		return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil disimpan!');
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
        $data['borrowing'] = Borrowing::findOrFail($id);
        $data['members'] = Member::all();
        $data['books'] = Book::all();
        $data['title'] = 'Edit Penyewaan';
        return view('pages.borrowings.edit', $data);
    }

    // Update the specified borrowing.
    public function update(StoreBorrowingRequest $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $request->validated();
        $borrowing->update($request->all());
        return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    // Remove the specified borrowing.
    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();
        return redirect()->route('penyewaan')->with('success', 'Peminjaman berhasil dihapus!');
    }
}

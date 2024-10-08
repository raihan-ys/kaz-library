<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
	// Display all books.
	public function index()
	{
		$data['books'] = Book::with('category', 'publisher')->get();
		$data['categories'] = Category::all();
		$data['publishers'] = Publisher::all();
		return view('pages.books.index', $data);
	}

	// Show a specified book detail.
	public function show($id) {
		$data['book'] = Book::find($id);
		return view('pages.books.show', $data);
	}

	// Insert book.
	public function store(StoreBookRequest $request)
	{
		// Input validation.
		$validated = $request->validated();

		// Create new book with validated data.
		Book::create($validated);

		return redirect()->route('buku')->with('success', 'Buku berhasil disimpan!');
	}

	// Show the form for editing the specified book.
	public function edit($id)
	{
		$data['book'] = Book::findOrFail($id);
		$data['categories'] = Category::all();
		$data['publishers'] = Publisher::all();
		return view('pages.books.edit', $data);
	}

	// Update specified book.
	public function update(UpdateBookRequest $request, $id)
	{
		// Find specified book.
		$book = Book::findOrFail($id);

		// Merge validated data with custom ISBN validation.
		$validated = array_merge(
			$request->validated(),
			['isbn' => $request->isbn],
		);

    // Custom validation for ISBN.
    $request->validate(
		[
			'isbn' => [
				'required',
				'string',
				'max:20',
				Rule::unique('books')->ignore($book->id),
			]
    ], 
		[
			'isbn.required' => 'ISBN wajib diisi!',
			'isbn.string' => 'ISBN harus berupa string!',
			'isbn.max' => 'panjang ISBN maksimal 20 karakter!',
			'isbn.unique' => 'ISBN ini sudah digunakan oleh buku lain!',
    ]);

		// Update book with all validated data.
		$book->update($validated);
		
		return redirect()->route('buku')->with('success', 'Buku berhasil diupdate!');
	}

	// Remove the specified book.
	public function destroy($id)
	{
		// Find specified book.
		$book = Book::findOrFail($id);

		// Delete specified book.
		$book->delete();

		return redirect()->route('buku')->with('success', 'Buku berhasil dihapus!');
	}
}

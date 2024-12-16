<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
	// Display all books.
	public function index()
	{
		$books = DB::table('books')
			->join('categories', 'books.category_id', '=', 'categories.id')
			->join('publishers', 'books.publisher_id', '=', 'publishers.id')
			->select('books.*', 'categories.name as category_name', 'publishers.name as publisher_name')
			->orderBy('title')
			->get();

		$categories = Category::orderBy('name')->get();
		$publishers = Publisher::orderBy('name')->get();

		return view('pages.books.index', compact('books', 'categories', 'publishers'));
	}

	// Show a specified book detail.
	public function show($id) {
		// Find the specified book.
		$book = Book::findOrFail($id);

		return view('pages.books.show', compact('book'));
	}

	// Insert book.
	public function store(StoreBookRequest $request)
	{
		// Input validation.
		$validated = $request->validated();
		
		// Handle file upload.
		if($request->hasFile('cover_image')) {
			$file = $request->file('cover_image');

			// Store the file and get the path.
			$path = $file->store('covers', 'public');
			// Save the path to the validated data.
			$validated['cover_image'] = $path;
		}

		// Create new book with validated data.
		try {
			$book = Book::create($validated);
			$id = $book->id;
		} catch(\Illuminate\Validation\ValidationException $e) {
			// Set file metadata in session to display to user.
			session()->flash('file_metadata', [
				'name' => $file->getClientOriginalName(),
				'size' => $file->getSize(),
				'type' => $file->getClientMimeType(),
			]);
			return redirect()->back()->withErrors($e->validator)->withInput();
		}

		return redirect()->route('buku.show', $id)->with('success', 'Buku berhasil disimpan!');
	}

	// Show the form for editing the specified book.
	public function edit($id)
	{
		// Find the specified book.
		$book = Book::findOrFail($id);

		$categories = Category::orderBy('name')->get();
		$publishers = Publisher::orderBy('name')->get();

		return view('pages.books.edit', compact('book', 'categories', 'publishers'));
	}

	// Update specified book.
	public function update(UpdateBookRequest $request, $id)
	{
		// Find the specified book.
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
			]
		);

		// If a file is uploaded as cover image.
		if($request->hasFile('cover_image')) {
			// Delete original file to replace it.
			$old_cover = $book->cover_image;
			if($old_cover) {
				Storage::disk('public')->delete($old_cover);
			}

			$file = $request->file('cover_image');

			// Store the new file and get the path.
			$path = $file->store('covers', 'public');

			// Save the path to the validated data.
			$validated['cover_image'] = $path;
		}

		// Update book with all validated data.
		$book->update($validated);

		return redirect()->route('buku.show', $id)->with('success', 'Buku berhasil diperbarui!');
	}

	// Remove the specified book.
	public function destroy($id)
	{
		// Find the specified book.
		$book = Book::findOrFail($id);

		// Delete book's cover image.
		if($book->cover_image) {
			Storage::disk('public')->delete($book->cover_image);
		}

		// Delete specified book.
		$book->delete();

		return redirect()->route('buku')->with('success', 'Buku berhasil dihapus!');
	}
}

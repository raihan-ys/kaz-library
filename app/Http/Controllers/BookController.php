<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
	// Display books.
	public function index()
	{
		$data['books'] = Book::with('category', 'publisher')->get();
		$data['categories'] = Category::all();
		$data['publishers'] = Publisher::all();
		$data['title'] = 'Daftar Buku';
		return view('pages.books.index', $data);
	}

	// Show the specified book.
	public function show($id) {
		$data['book'] = Book::find($id);
		$data['title'] = 'Detail Buku: '.$data['book']->title;
		return view('pages.books.show', $data);
	}

	// Store a newly created book in the database.
	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'author' => 'required',
			'isbn' => 'required',
			'published_year' => 'required|integer',
			'category_id' => 'required|integer',
			'publisher_id' => 'required|integer',
			'cover_image' => 'nullable|string',
			'stock' => 'required|integer',
			'rental_price' => 'required|integer',
		]);
		Book::create($request->all());
		return redirect()->route('buku.index')->with('success', 'Buku berhasil disimpan!');
	}

	// Show the form for editing the specified book.
	public function edit($id)
	{
		$data['book'] = Book::find($id);
		$data['categories'] = Category::all();
		$data['publishers'] = Publisher::all();
		$data['title'] = 'Edit Buku';
		return view('pages.books.edit', $data);
	}

	// Update the specified book in the database.
	public function update(Request $request, $id)
	{
		$book = Book::find($id);
		$request->validate([
			'title' => 'required|max:100',
			'author' => 'required|max:100',
			'published_year' => 'required|integer|',
			'category_id' => 'required|integer',
			'publisher_id' => 'required|integer',
			'cover_image' => 'nullable|string',
			'stock' => 'required|integer',
			'rental_price' => 'required|integer',
		]);
		$book->update($request->all());
		return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate!');
	}

	// Remove the specified book from the database.
	public function destroy($id)
	{
		$book = Book::find($id);
		$book->delete();
		return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
	}
}
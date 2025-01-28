<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
	// Display categories.
	public function index()
	{
		$categories = Category::orderBy('name')->get();
		
		return view('pages.categories.index', compact('categories'));
	}

	// Remove the specified category.
	public function destroy($id)
	{
		// Check if the specified category exist.
		$ctg = Category::find($id);

		$ctg->delete();

		return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus!');
	}

	// Display soft deleted categories.
	public function trashed()
	{
		$categories = Category::onlyTrashed()->orderBy('name')->get();
		
		return view('pages.categories.trashed', compact('categories'));
	}

	// Restore the specified category.
	public function restore($id)
	{
		$category = Category::withTrashed()->findOrFail($id);
		$category->restore();
		
		return redirect()->route('kategori')->with('success', 'Kategori berhasil dipulihkan!');
	}

	// Force delete the specified category.
	public function forceDelete($id)
	{
		$category = Category::withTrashed()->findOrFail($id);
		$category->forceDelete();
		
		return redirect()->route('kategori.trashed')->with('success', 'Kategori berhasil dihapus secara permanen!');
	}
}
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
}
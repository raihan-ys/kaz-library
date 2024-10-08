<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
	// Display categories.
	public function index()
	{
		$data['categories'] = Category::all();
		return view('pages.categories.index', $data);
	}

	// Remove the specified category.
	public function destroy($id)
	{
		$ctg = Category::find($id);
		$ctg->delete();
		return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus!');
	}
}
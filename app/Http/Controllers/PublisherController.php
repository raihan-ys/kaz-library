<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
	
use Illuminate\Routing\Controller;

class PublisherController extends Controller
{
	// Display publishers.
	public function index()
	{
		$publishers = Publisher::orderBy('name')->get();
		return view('pages.publishers.index', compact('publishers'));
	}

	// Remove the specified publisher.
	public function destroy($id)
	{
		// Check if the specified publisher exist.
		$publisher = Publisher::find($id);

		$publisher->delete();
		
		return redirect()->route('penerbit')->with('success', 'Penerbit berhasil dihapus!');
	}

	// Display soft deleted publishers.
	public function trashed()
	{
			$publishers = Publisher::onlyTrashed()->orderBy('name')->get();
			
			return view('pages.publishers.trashed', compact('publishers'));
	}

	// Restore the specified publisher.
	public function restore($id)
	{
		$publisher = Publisher::withTrashed()->findOrFail($id);
		$publisher->restore();
		
		return redirect()->route('penerbit')->with('success', 'Penerbit berhasil dipulihkan!');
	}

	// Force delete the specified publisher.
	public function forceDelete($id)
	{
		$publisher = Publisher::withTrashed()->findOrFail($id);
		$publisher->forceDelete();
		
		return redirect()->route('penerbit.trashed')->with('success', 'Penerbit berhasil dihapus secara permanen!');
	}
}

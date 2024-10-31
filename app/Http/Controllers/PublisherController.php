<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
	
use Illuminate\Routing\Controller;

class PublisherController extends Controller
{
	// Display publishers.
	public function index()
	{
		$data['publishers'] = Publisher::all();
		return view('pages.publishers.index', $data);
	}

	// Remove the specified publisher.
	public function destroy($id)
	{
		// Check if the specified publisher exist.
		$pbs = Publisher::find($id);

		$pbs->delete();
		
		return redirect()->route('penerbit')->with('success', 'Penerbit berhasil dihapus!');
	}
}

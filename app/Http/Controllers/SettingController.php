<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class SettingController extends Controller
{
	public function index()
	{	
		return view('pages.settings.index');
	}
}

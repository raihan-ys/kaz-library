<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountController extends Controller
{
	public function index()
	{
		return view('pages.account.index');
	}
}

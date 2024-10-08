<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $librarians = User::select('id', 'name', 'email', 'created_at') ->get();

        return view('pages.users.index', compact('librarians'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        $data['description'] = 'Selamat datang di e-Library Institut Az Zuhra, pusat sumber informasi digital yang dirancang untuk mendukung kebutuhan akademik dan penelitian Anda. Kami bangga menyediakan koleksi buku elektronik, jurnal ilmiah, makalah penelitian, dan berbagai sumber daya lainnya yang dapat diakses dengan mudah dan cepat.';
        return view('pages.home', $data);
    }
}

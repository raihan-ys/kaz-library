<!DOCTYPE html>
<html lang="en">
<head>
	{{-- meta --}}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Library Institut Az Zuhra">
	<title>Home - Kaz-Library</title>
	{{-- Favicon --}}	
	<link type="image/png" href="{{ asset('images/logo.webp') }}" rel="icon">
	{{-- AdminLTE CSS --}}
	<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    {{-- Font --}}
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Custom CSS --}}
    <style>
        /* fonts */
        @font-face {
        font-family: "Poppins";
        src: url("{{ asset('fonts/poppins/poppins.woff2') }}") format("truetype");
        font-weight: normal;
        font-style: normal;
        }
        @font-face {
        font-family: "Play";
        src: url("{{ asset('fonts/play/play.woff2') }}") format("truetype");
        font-weight: normal;
        font-style: normal;
        }
        @font-face {
        font-family: "Press Start 2P";
        src: url("{{ asset('fonts/pressStart2P/pressStart2P.woff2') }}") format("truetype");
        font-weight: normal;
        font-style: normal;
        }
        /* /.fonts */

        /* reset CSS */
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        transition: background-color 300ms ease, color 300ms ease;
        }
        /* /.reset CSS */

        /* body */
        body {
            color: rgba(33, 37, 41, 1);
            font-family: "Poppins", sans-serif;
        }
        body::-webkit-scrollbar {
        width: 5px;	 
        }
        body::-webkit-scrollbar-track {
        background-color: rgb(60, 60, 60);
        }
        body::-webkit-scrollbar-thumb {
        background-color: red;
        border-radius: 5px;
        }
        /* /.body */

        /* navbar */
        .navbar, .footer {
        background-color: #181C32;
        }
            .navbar span {
        color: orangered;
        font-family: "Press Start 2P", sans-serif;
        font-weight: 100;
        font-size: 20px;
        }
        .navbar .nav-item a {
                    font-family: "Play", sans-serif;
        border-radius: 5px;
        color: white;
        height: 38px;
        padding: 10px;
        text-decoration: none;
        }
        .navbar .nav-item a:hover,
        .navbar .nav-item a:focus {
        background-color: #252941;
        color: rgba(255, 255, 255, .8);
        }
        /* /.navbar */

        /* footer */
        footer ul {
        gap: 10px;
        }
        footer ul li img {
        height: 30px;
        }
        /* /.footer */

        .jumbotron {
        max-height: 400px;
        }

        /* carousel */
        .carousel-item img {
        left: 50%;
        transform: translateX(-50%);
        }
        /* /.carousel */

        @media (max-width: 767px) {
        /* jumbotron */
        .jumbotron {
            height: auto !important;
            max-height: max-content;
        }
        /* /.jumbotron */

        /* carousel */
        .carousel-item img {
            position: static !important;
            width: 100% !important;
            transform: none !important;
        }
        /* /.carousel */
        }
    </style>
	{{-- jQuery JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
	{{-- Bootstrap JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    
	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container">

			{{-- brand logo --}}
			<a class="navbar-brand" href="#">
				<img class="rounded img-fluid" style="max-width: 100%; height: 100px;" src="{{ asset('images/logo.webp') }}" alt="Logo Kaz-library">
			<a>

			{{-- navbar toggler --}}
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
				&#9776;
			</button>
            
			<div class="collapse navbar-collapse" id="navbarNav">
                <!-- name -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<span>
							Kaz-Library
						</span>
					</li> 
				</ul>

                {{-- content --}}
				<ul class="navbar-nav ml-auto">
                    {{-- home --}}
					<li class="nav-item">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    {{-- visi misi --}}
                    <li class="nav-item">
                        <a href="#visiMisi">
                            <i class="fas fa-eye"></i>
                            Visi & Misi
                        </a>
                    </li>
                    {{-- features --}}
                    <li class="nav-item">
                        <a href="#features">
                            <i class="fas fa-book"></i>
                            Fitur
                        </a>
                    </li>
                    {{-- newest books --}}
                    <li class="nav-item">
                        <a  href="#newestBooks">
                            <i class="fas fa-book"></i>
                            Buku Terbaru
                        </a>
                    </li>
                    {{-- most borrowed --}}
                    <li class="nav-item">
                        <a  href="#mostBorrowed">
                            <i class="fas fa-book"></i>
                            Buku Terlaris
                        </a>
                    </li>
			    </ul>
                {{-- /.content --}}
	        </div>
        </div>
    </nav>
    
	<div class="container p-3 flex-grow-1">
		{{-- hero --}}
        <div class="jumbotron row p-0" style="background-color: #181C32; height: 70vh">
            {{-- carousel --}}
            <div class="col-md-6 p-0 h-100 position-relative overflow-hidden"> 
                <div class="carousel slide h-100 w-100" id="heroCarousel" data-ride="carousel">
                    {{-- indicator --}}
                    <ol class="carousel-indicators">
                        <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#heroCarousel" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner h-100">
                        {{-- slide 1 --}}
                        <div class="carousel-item active h-100">
                            <img src="{{ asset('images/slide1.jpg') }}" alt="Mahasiswa Manajemen Informatika" class="position-absolute w-auto h-100 object-fit-cover">
                        </div>
                        {{-- slide 2 --}}
                        <div class="carousel-item h-100">
                            <img src="{{ asset('images/slide2.jpg') }}" alt="Mahasiswa Teknik Komputer" class="position-absolute w-auto h-100 object-fit-cover">
                        </div>
                    </div>
                    {{-- controls --}}
                    <button class="carousel-control-prev" type="button" data-target="#heroCarousel" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#heroCarousel" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
            {{-- /.carousel --}}
            {{-- text --}}
            <div class="col-md-6 p-3 text-white d-flex flex-column justify-content-center">
                <h3 class="font-weight-bold">
                    Selamat Datang di
                    <span class="font-weight-bolder h3" style="color: orangered">Kaz-Library</span>
                    !
                </h3>
                <p style="text-align: justify;">
                    Selamat datang di e-Library Kazee, pusat sumber informasi digital yang dirancang untuk mendukung kebutuhan akademik dan penelitian Anda. Kami bangga menyediakan koleksi buku, jurnal ilmiah, makalah penelitian, dan berbagai sumber daya lainnya yang dapat diakses dengan mudah dan cepat.
                </p>
                @guest
                <a class="btn btn-outline-light" href="{{ route('login') }}">
                    <i class="fas fa-key"></i>
                    Login
                </a>
                @else
                <a class="btn btn-outline-light" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Masuk ke Dashboard
                </a>
                @endguest
            </div>
            {{-- /.text --}}
        </div>
        {{-- /.hero --}}

        {{-- visi misi --}}
        <div class="mt-5 p-3 card bg-light" id="visiMisi" style="border-top: 10px solid #181C32;">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="font-weight-bold">Visi & Misi</h2>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-transparent">
                        <div class="card-body">
                            <h4 class="card-title font-weight-bold" style="color: orangered"><i class="fas fa-eye mr-2"></i>Visi</h4>
                            <br>
                            <em class="card-text">
                                "Menjadi pusat pengetahuan terdepan yang mendukung pembelajaran, penelitian, dan inovasi, serta berkontribusi pada pengembangan ilmu pengetahuan di Indonesia."
                            </em>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-transparent">
                        <div class="card-body">
                            <h4 class="card-title font-weight-bold" style="color: orangered"><i class="fas fa-bullseye mr-2"></i>Misi</h4>
                            <ul class="card-text pl-4">
                                <li>Menyediakan akses mudah dan cepat ke sumber daya informasi berkualitas tinggi.</li>
                                <li>Mendukung kebutuhan akademik dan penelitian.</li>
                                <li>Mengembangkan koleksi yang komprehensif dan relevan dengan kurikulum dan riset terkini.</li>
                                <li>Meningkatkan literasi dan kemampuan penelitian pengguna melalui pelatihan dan bimbingan.</li>
                                <li>Berkolaborasi dengan institusi pendidikan dan perpustakaan lain untuk memperluas jangkauan sumber daya.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- visi misi --}}

        {{-- features --}}
        <div class="row mt-5" id="features">
            {{-- register link --}}
            <div class="col-md-3 p-2 pr-3">
                <h2>Ayo Daftar!</h2>
                <p style="text-align: justify;">
                    Dengan mendaftar menjadi anggota perpustakaan ini, Anda akan menikmati berbagai keuntungan yang dirancang untuk mendukung kebutuhan informasi dan pengembangan pengetahuan Anda. Sebagai anggota, Anda mendapatkan akses eksklusif ke koleksi buku, jurnal, dan e-resources yang lengkap dan selalu diperbarui!
                </p>
                <a class="btn btn-outline-primary" href="#">Pendaftaran</a> 
            </div>
            {{-- card 1 --}}
            <div class="col-md-3 p-2">
                <div class="card h-100">
                    <div class="card-header p-0">
                        <img class="w-100" src="{{ asset('images/books.jpeg') }}" alt="Gambar Koleksi Buku">
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-bold">Koleksi Buku</h5>
                        <small>Hingga Buku Dengan Bahasa Asing</small>
                        <p class="mt-2" style="text-align: justify;">Menawarkan koleksi buku teks yang lengkap dan bervariasi, mencakup berbagai bidang ilmu pengetahuan, sastra, dan teknologi.</p>
                    </div>
                </div>
            </div>
            {{-- card 2 --}}
            <div class="col-md-3 p-2">
                <div class="card h-100">
                    <div class="card-header p-0">
                        <img class="w-100" src="{{ asset('images/journals.jpeg') }}" alt="Gambar Koleksi Jurnal">
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-bold">Koleksi Jurnal</h5>
                        <small>Mencakup Publikasi Terbaru dan Edisi-edisi Penting</small>
                        <p class="mt-2" style="text-align: justify;">
                            Memiliki koleksi jurnal yang lengkap dan beragam, mencakup berbagai disiplin ilmu baik dari dalam negeri maupun internasional.</p>
                    </div>
                </div>
            </div>
            {{-- card 3 --}}
            <div class="col-md-3 p-2">
                <div class="card h-100">
                    <div class="card-header p-0">
                        <img class="w-100" src="{{ asset('images/library.jpeg') }}" alt="Mahasiswa Manajemen Informatika">
                    </div>
                    <div class="card-body" text-light>
                        <h5 class="font-weight-bold">Ruang Baca</h5>
                        <small>Ruang Baca yang Nyaman</small>
                        <p class="mt-2" style="text-align: justify;" 267>Perpustakaan ini menyediakan ruang baca yang nyaman dan tenang, dirancang khusus untuk mendukung suasana belajar dan penelitian yang kondusif.</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- /.features --}}

        {{-- book collection --}}
        <div class="container mt-5" id="newestBooks">
            {{-- recommended --}}
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-center mb-4">Buku Terbaru & Rekomendasi</h2>
                </div>
                @for ($i = 1; $i <= 4; $i++)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/journals.jpeg') }}" class="card-img-top" alt="Buku {{ $i }}">
                        <div class="card-body">
                            <h5 class="card-title">Judul Buku {{ $i }}</h5>
                            <p class="card-text">Penulis: Nama Penulis {{ $i }}</p>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            {{-- most borrowed --}}
            <div class="row" id="mostBorrowed">
                <div class="col-12">
                    <h2 class="text-center mb-4">Buku Terlaris</h2>
                </div>
                @for ($i = 1; $i <= 4; $i++)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/books.jpeg') }}" class="card-img-top" alt="Buku Terlaris {{ $i }}">
                        <div class="card-body">
                            <h5 class="card-title">Judul Buku Terlaris {{ $i }}</h5>
                            <p class="card-text">Penulis: Nama Penulis {{ $i }}</p>
                            <p class="card-text"><small class="text-muted">Dipinjam: {{ rand(50, 200) }} kali</small></p>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
        {{-- /.book collection --}}
	</div>
	<footer class="footer p-3">
        <div class="container">
            <p class="text-white text-center mb-1">&copy; {{ date('Y') }} Kaz-Library. All rights reserved.</p>
            <!-- links -->
            <ul class="d-flex justify-content-center list-unstyled m-0">	
                <!-- facebook -->
                <li>
                    <a href="https://www.facebook.com/amik.atd.16" target="_blank">
                        <img src="{{ asset('images/facebook-logo.png') }}" alt="facebook link">
                    </a>
                </li>
                <!-- instagram -->
                <li>
                    <a href="https://www.instagram.com/institut.azzuhra/" target="_blank">
                        <img src="{{ asset('images/instagram-logo.png') }}" alt="instagram link">
                    </a>
                </li>
                <!-- twitter -->
                <li>
                    <a href="https://x.com/" target="_blank">
                        <img src="{{ asset('images/twitter-logo.png') }}" alt="twitter link">
                    </a>
                </li>
                <!-- whatsapp -->
                <li>
                    <a href="https://wa.me/6281990576161" target="_blank">
                        <img src="{{ asset('images/whatsapp-logo.png') }}" alt="whatsapp link">
                    </a>
                </li>
            </ul>
            <!-- /.links -->
        </div>
    </footer>   
</body>
</html>

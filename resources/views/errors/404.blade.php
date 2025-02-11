<!DOCTYPE html>
<html lang="en">
<head>
	{{-- meta --}}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Library">
	<title>404 - {{ config('app.name', 'Kaz-Library') }}</title>
	{{-- Favicon --}}	
	<link type="image/png" href="{{ asset('images/logo.jpg') }}" rel="icon">
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
            width: 10px;	 
        }
        body::-webkit-scrollbar-track {
            background-color: rgb(60, 60, 60);
        }
        body::-webkit-scrollbar-thumb {
            background-color: red;
            border-radius: 10px;
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

        /* carousel */
        .carousel-item img {
            left: 50%;
            transform: translateX(-50%);
        }
        /* /.carousel */

        @media (max-width: 767px) {
            /* jumbotron */
            .jumbotron-fluid {
                height: auto !important;
                max-height: max-content;
                margin: 0;
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
			<a class="navbar-brand" href="{{ route('home') }}">
				<img class="rounded img-fluid" style="max-width: 100%; height: 100px;" src="{{ asset('images/logo.jpg') }}" alt="Logo {{ config('app.name', 'Kaz-Library') }}">
            </a>

			{{-- navbar toggler --}}
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
				&#9776;
			</button>
            
			<div class="collapse navbar-collapse" id="navbarNav">
                <!-- name -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<span>
							{{ config('app.name', 'Kaz-Library') }}
						</span>
					</li> 
				</ul>
	        </div>
        </div>
    </nav>

    {{-- content --}}
    <div class="container p-3 flex-grow-1 text-center">
        <img src="{{ asset('images/404.jpg') }}" alt="404 image" class="img-fluid">
        <h1 class="text-danger">404</h1>
        <h2 class="text-danger">Halaman Tidak Ditemukan!</h2>
        <p class="text-danger">Halaman mungkin tidak tersedia, atau sedang dalam perbaikan.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Home</a>
    </div>
    {{-- /.content --}}
    
	<footer class="footer p-3">
        <div class="container">
            <p class="text-white text-center mb-1">&copy; {{ date('Y') }} {{ config('app.name', 'Kaz-Library') }}. All rights reserved.</p>
            <!-- links -->
            <ul class="d-flex justify-content-center list-unstyled m-0">	
                <!-- facebook -->
                <li>
                    <a href="https://www.facebook.com/kazeeid" target="_blank">
                        <img src="{{ asset('images/facebook-logo.png') }}" alt="facebook link">
                    </a>
                </li>
                <!-- instagram -->
                <li>
                    <a href="https://www.instagram.com/kazeeid" target="_blank">
                        <img src="{{ asset('images/instagram-logo.png') }}" alt="instagram link">
                    </a>
                </li>
                <!-- x -->
                <li>
                    <a href="https://x.com" target="_blank">
                        <img src="{{ asset('images/x-logo.png') }}" alt="x link">
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

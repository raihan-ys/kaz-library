<!DOCTYPE html>
<html lang="en">

<head>
	{{-- meta --}}
	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Library">

 	<title>@yield('title') - {{ config('app.name', 'Kaz-Library') }}</title>

	{{-- Favicon --}}
	<link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">
	{{-- Font Awesome CSS --}}
 	<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
	{{-- AdminLTE CSS --}}
 	<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
 	<!-- Custom CSS -->
 	<style>
		/* fonts */
		@font-face {
			font-family: "Poppins";
			src: url("{{ asset('fonts/poppins/poppins.woff2') }}") format("truetype");
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

		body {
			color: rgba(33, 37, 41, 1);
			font-family: "Poppins", sans-serif;
			background-repeat: no-repeat;
			background-size: cover;
			background-image: url({{ asset('images/login-wallpaper.jpg') }});
		}

		/* brand-text */
		.brand-text {
			display: flex;
			flex-direction: row
		}
		.brand-text img {
			margin-right: 10px;
		}
		/* /.brand-text */

		@media (max-width: 992px) {
			.brand-text {
				flex-direction: column;
			}
			.brand-text img {
				margin-right: 0px;
				margin-bottom: 10px;
			}
		}
 	</style>

	{{-- jQuery JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="hold-transition login-page">

	{{-- success message --}}
	@if(session('success'))
	<div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
		{{-- toast header --}}
		<div class="toast-header" style="font-size: 20px;">
			<i class="fas fa-check mr-1"></i>
			<strong class="mr-auto">Sukses!</strong>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{-- toast body --}}
		<div class="toast-body" style="font-size: 15px">
			{{ session('success') }}
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('.toast').toast({ delay: 5000 });
			$('.toast').toast('show');
		});
	</script>
	@endif
	{{-- /.success message --}}

	{{-- login box --}}	
	<div class="row d-flex flex-row align-items-center">
		{{-- brand text --}}
		<div class="col-12 col-lg-6">
			<a href="{{ url('/') }}" class="brand-text align-items-center text-danger mb-3">
				<img src="{{ asset('images/logo.png') }}" alt="logo " class="img-fluid img-rounded" style="width: 100px; height: 100px;">
				<b style="font-size: 1rem; font-family: 'Press Start 2P', sans-serif;">{{ config('app.name', 'Kaz-Library') }}</b>
			</a>
		</div>
		{{-- /.brand text --}}
		<div class="col-12 col-lg-6">
 			@yield('content')
		</div>
 	</div>
 	<!-- /.login-box -->

	{{-- Bootstrap 4 JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	@yield('js')
</body>
</html>

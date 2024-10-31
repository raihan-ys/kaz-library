<!DOCTYPE html>
<html lang="en">

<head>
	{{-- meta --}}
	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Library Kazee Digital">

 	<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

	{{-- Favicon --}}
	<link rel="shortcut icon" href="{{ asset('images/logo.webp') }}">
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
			background-image: url({{ asset('images/library.jpeg') }});
		}

		.login-box {
			margin-top: 3%;
		}

		.login-logo {
			background-color: orangered;
		}
		.login-logo a {
			font-family: "Press Start 2P", sans-serif;
			font-size: 1.5rem;
		}
 	</style>
</head>

<body class="hold-transition login-page">
	{{-- login box --}}
	<div class="login-box">
		{{-- logo --}}
 		<div class="login-logo rounded">
 			<a href="{{ url('/') }}" class="text-white">
				<b>{{ config('app.name', 'Kaz-Library') }}</b>
			</a>
 		</div>
 		<!-- /.logo -->
 		@yield('content')
 	</div>
 	<!-- /.login-box -->

	<!-- AdminLTE JS -->
	<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
	{{-- Custom JS --}}
	<script type="text/javascript">
		$(document).ready(function() {
			// Get elements.
			const closeAlert = $("#closeAlert");

			// Close alerts.
			closeAlert.click(function() {
				closeAlert.parent().hide();
			});
		});
	</script>
	@yield('js')
</body>
</html>

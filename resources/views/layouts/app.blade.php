<!DOCTYPE html>
<html lang="en">

<head>
	<!-- meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Library Institut Az Zuhra">

	<title>@yield('title', $title) - Institut Az Zuhra</title>

	{{-- Favicon --}}
	<link type="image/png" href="{{ asset('images/iaz-logo.png') }}" rel="icon">
	{{-- Bootstrap CSS --}}
	<link type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	{{-- Font Awesome CSS --}}
	<link type="text/css" href="{{ asset('vendor/fontawesome6/css/all.css') }}" rel="stylesheet">
	{{-- jQuery JS --}}
	<script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	{{-- Bootstrap JS --}}
	<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100">
	@include('partials.navbar')
	@include('partials.header')
	<div class="container mt-4 flex-grow-1">
		@yield('content')
	</div>
	@include('partials.footer')
</body>
</html>

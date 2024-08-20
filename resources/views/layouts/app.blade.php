<!DOCTYPE html>
<html lang="en">

<head>
	{{-- meta --}}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Library Kazee Digital">

	<title>@yield('title', $title) - Kaz-Library</title>

	{{-- Favicon --}}
	<link rel="shortcut icon" href="{{ asset('images/stormtrooper.jfif') }}">
	{{-- AdminLTE CSS --}}
	<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
	{{-- Font Awesome CSS --}}
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
	{{-- Overlay Scrollbars CSS --}}
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	@yield('css')
	
	{{-- jQuery JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		{{-- navbar --}}
		@include('partials.navbar')
		{{-- sidebar --}}
		@include('partials.sidebar')

		{{-- content --}}
		<div class="content-wrapper">
			{{-- content header --}}
			@yield('page-header')
			{{-- main content --}}
			<section class="content">
				@yield('content')
			</section>
		</div>
		{{-- footer --}}
		@include('partials.footer')

		{{-- sidebar control --}}
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	{{-- /.wrapper --}}

	{{-- Bootstrap 4 JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	{{-- overlayScrollbars JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"><script>
	{{-- AdminLTE JS --}}
	<script type="text/javascript" src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
	@yield('js')
</body>
</html>

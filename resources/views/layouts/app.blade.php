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
	{{-- Google Font
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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

<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Poppins', sans-serif">
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
	{{-- Custom JS --}}
	<script type="text/javascript">
		$(document).ready(function() {
			// Get elements.
			const deleteForm = $(".delete_form");
			const deleteSubmit = $(".delete_submit");
			const closeAlert = $("#closeAlert");
			
			// Delete confirmation.
			deleteSubmit.click(function(event) {
				if(!confirm("Anda yakin ingin menghapus data ini?")) {
					event.preventDefault();
				}
			});
			// Close alerts.
			closeAlert.click(function() {
				closeAlert.parent().hide();
			});
		});
	</script>
	@yield('js')
</body>
</html>

<nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #181C32">
	{{-- Left navbar links --}}
	<ul class="navbar-nav">
		<!-- sidebar toggler -->
    <li>
      <a class="nav-link" title="show or hide the sidebar's content" data-bs-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
	</ul>
	{{-- Right navbar links --}}
	<ul class="navbar-nav ml-auto">

		{{-- logout --}}
		<li class="nav-item dropdown">

			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="fas fa-user"></i>
				{{ Auth::user()->name }}
			</a>
			
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
					<i class="fas fa-power-off"></i>	
					{{ __('Logout') }}
				</a>
				<form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
		 			@csrf
 				</form>
 			</div>
		</li>
		{{-- /.logout --}}

		{{-- fullscreen --}}
		<li class="nav-item">
			<a class="nav-link" style="color: orangered" data-bs-widget="fullscreen" title="Expand page" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
		{{-- /.fullscreen --}}

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

	</ul>
	{{-- /.Right navbar links --}}
</nav>

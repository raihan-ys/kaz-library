<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #181C32;">
	<div class="container">

		{{-- brand logo --}}
		<a class="navbar-brand py-4" href="https://www.institutazzuhra.ac.id/" target="_blank">
			<img class="rounded img-fluid" style="max-width: 100%; height: 100px" src="{{ asset('images/iaz-logo-white.jpg') }}" alt="Logo Institut Az Zuhra">
		</a>

		{{-- navbar toggler --}}
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
			&#9776;
		</button>

		{{-- content --}}
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">

				{{-- home --}}
				<li class="nav-item active">
					<a class="nav-link" href="{{ url('home') }}">
						<i class="fas fa-home"></i>
						Home
					</a>
				</li>

				{{-- book --}}
				<li class="nav-item active">
					<a class="nav-link" href="{{ url('buku') }}">
						<i class="fas fa-book"></i>
						Buku
					</a>
				</li>
			</ul>
		</div>
		{{-- /.content --}}
	</div>
</nav>

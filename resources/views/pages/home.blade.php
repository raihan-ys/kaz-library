@extends('layouts.app')
@section('title')
@section('content')
{{-- hero section --}}
<div class="jumbotron row p-0" style="background-color: purple">
	{{-- carousel --}}
	<div class="col-md-6 my-3"> 
		<div class="carousel slide" id="carouselHero" data-ride="carousel">
			{{-- indicator --}}
			<ol class="carousel-indicators">
				<li data-target="#carouselHero" data-slide-to="0" class="active"></li>
				<li data-target="#carouselHero" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner">
				{{-- slide 1 --}}
				<div class="carousel-item active">
					<img src="{{ asset('images/slide1.jpg') }}" alt="Mahasiswa Manajemen Informatika" class="d-block active w-100 rounded">
				</div>
				{{-- slide 3 --}}
				<div class="carousel-item">
					<img src="{{ asset('images/slide2.jpg') }}" alt="Mahasiswa Teknik Komputer" class="d-block w-100">
				</div>
			</div>
			{{-- controls --}}
			<button class="carousel-control-prev" type="button" data-target="#carouselHero" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-target="#carouselHero" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</button>
		</div>
	</div>
	{{-- /.carousel --}}
	{{-- hero --}}
	<div class="col-md-6 text-white my-3">
		<h4>Selamat Datang di
			<span class="font-weight-bold" style="color: skyblue">E-Library</span>
			Institut Az Zuhra!
		</h4>
		<p>
			{{ $description }}
		</p>
		<a class="btn btn-outline-light" href="#">Jelajahi</a>
	</div>
	{{-- /.hero --}}
</div>
{{-- /.hero section --}}

<hr>

{{-- features --}}
<div class="row">
	{{-- /.register link --}}
	<div class="col-sm-3 p-2">
		<h2>Ayo Daftar!</h2>
		<p>
			Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit vitae, veniam velit quam expedita repellendus animi sunt illo hic temporibus, aspernatur quia libero ab minima id suscipit doloribus ex natus.
		</p>
		<a class="btn btn-outline-primary" href="#">Pendaftaran</a> 
	</div>
	{{-- card 1 --}}
	<div class="col-md-3 p-2">
		<div class="card">
			<div class="card-header p-0">
				<img src="{{ asset('images/slide1.jpg') }}" alt="Mahasiswa Manajemen Informatika" style="width: 100%;">
			</div>
			<div class="card-body">
				<h5 class="font-weight-bold">Title</h5>
				<small>Write Meta here...</small>
				<p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta maiores, error animi accusamus numquam facilis soluta explicabo libero alias corrupti similique reprehenderit tempore, non, culpa eaque repellat omnis? Iure, cupiditate.</p>
			</div>
		</div>
	</div>
	{{-- card 2 --}}
	<div class="col-md-3 p-2">
		<div class="card">
			<div class="card-header p-0">
				<img src="{{ asset('images/slide1.jpg') }}" alt="Mahasiswa Manajemen Informatika" style="width: 100%;">
			</div>
			<div class="card-body">
				<h5 class="font-weight-bold">Title</h5>
				<small>Write Meta here...</small>
				<p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta maiores, error animi accusamus numquam facilis soluta explicabo libero alias corrupti similique reprehenderit tempore, non, culpa eaque repellat omnis? Iure, cupiditate.</p>
			</div>
		</div>
	</div>
	{{-- card 3 --}}
	<div class="col-md-3 p-2">
		<div class="card">
			<div class="card-header p-0">
				<img src="{{ asset('images/slide1.jpg') }}" alt="Mahasiswa Manajemen Informatika" style="width: 100%;">
			</div>
			<div class="card-body">
				<h5 class="font-weight-bold">Title</h5>
				<small>Write Meta here...</small>
				<p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta maiores, error animi accusamus numquam facilis soluta explicabo libero alias corrupti similique reprehenderit tempore, non, culpa eaque repellat omnis? Iure, cupiditate.</p>
			</div>
		</div>
	</div>
</div>
{{-- /.features --}}
@endsection

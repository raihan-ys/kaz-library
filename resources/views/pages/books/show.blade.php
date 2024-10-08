@extends('layouts.app')
@section('title', 'Detail Buku - Kaz-Library')
@section('page-header')
<div class="row">
	<div class="col-12 col-lg-8 offset-lg-2">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">

					{{-- page title --}}
					<div class="col-sm-6">
						<h1>Detail Buku</h1>
					</div>

					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('penyewaan') }}">
									<i class="fas fa-book"></i>
									Buku
								</a>
							</li>
							<li class="breadcrumb-item active">
								Detail
							</li>
						</ol>
					</div>
					{{-- /.breadcrumb --}}
				</div>
			</div>
		</section>
	</div>
</div>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-lg-8 offset-2">
			<div class="card" style="border-top: #181C32 solid 5px">
				<div class="card-header">
					<h5 class="font-weight-bold">{{ $book->title }}</h5>
				</div>
				
				<div class="card-body row">
					{{-- book cover --}}
					<div class="m-auto">
						<img src="{{ asset('images/logo.webp') }}" alt="Book's cover image" class="rounded img-fluid" style="width: 300px; height: 300px">
					</div>
			
					<div class="col-md-8 table-responsive">
						<table class="table">
							{{-- title --}}
							<tr>
								<th scope="row">Judul</th>
								<td>{{ $book->title }}</td>
							</tr>
							{{-- author --}}
							<tr>
								<th scope="row">Penulis</th>
								<td>{{ $book->author }}</td>
							</tr>
							{{-- published year --}}
							<tr>
								<th scope="row">Tahun Terbit</th>
								<td>{{ $book->published_year }}</td>
							</tr>
							{{-- category id --}}
							<tr>
								<th scope="row">Kategori</th>
								<td>{{ $book->category->name }}</td>
							</tr>
							{{-- publisher --}}
							<tr>
								<th scope="row">Penerbit</th>
								<td>{{ $book->publisher->name }}</td>
							</tr>
							{{-- stock --}}
							<tr>
								<th scope="row">Stok</th>
								<td>{{ $book->stock }}</td>
							</tr>
							{{-- rental price --}}
							<tr>
								<th scope="row">Biaya Peminjaman</th>
								<td>{{ $book->rental_price }}</td>
							</tr>
						</table>
					</div>
				</div>
				{{-- /.body --}}
				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('buku') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('layouts.app')
@section('page-header')
<div class="row">
	<div class="col-12">
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
								Detail Buku
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

	<div class="card" style="border-top: #181C32 solid 5px">
		<div class="card-header">
			<h5 class="font-weight-bold">{{ $book->title }}</h5>
		</div>
		
		<div class="card-body table-responsive">
			<table class="table" style="width: max-content">
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
					<td>{{ $book->category_id }}</td>
				</tr>
				{{-- publisher --}}
				<tr>
					<th scope="row">Penerbit</th>
					<td>{{ $book->publisher_id }}</td>
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
</div>
@endsection

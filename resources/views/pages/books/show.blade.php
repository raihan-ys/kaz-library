@extends('layouts.app')
@section('title', 'Detail Buku')
@section('page-header')
<div class="row m-0">
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
								<a href="{{ route('buku') }}">
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
		<div class="col-12 col-lg-8 offset-lg-2">
			<div class="card" style="border-top: #181C32 solid 5px">
				<div class="card-header">
					<h5 class="font-weight-bold">Detail Buku</h5>
				</div>
				
				<div class="card-body">

					{{-- book data --}}
					<div class="row">
						{{-- book cover image --}}
						<div class="m-auto">
							<img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : asset('images/sample-book-cover.png') }}" alt="Book's Cover Image Preview" class="img-fluid img-thumbnail" style="max-width: 300px">
						</div>
				
						<div class="col-md-8">
							{{-- title --}}
							<div class="form-group">
								<label for="title">Judul</label>
								<p id="title">{{ $book->title }}</p>
							</div>

							{{-- author --}}
							<div class="form-group">
								<label for="author">Penulis</label>
								<p id="author">{{ $book->author }}</p>
							</div>

							{{-- isbn --}}
							<div class="form-group">
								<label for="isbn">ISBN</label>
								<p id="isbn">{{ $book->isbn }}</p>
							</div>

							{{-- published year --}}
							<div class="form-group">
								<label for="published_year">Tahun terbit</label>
								<p id="published_year">{{ $book->published_year }}</p>
							</div>

							{{-- category --}}
							<div class="form-group">
								<label for="category_id">Kategori</label>
								<p id="category_id">{{ $book->category->name }}</p>
							</div>

							{{-- publisher --}}
							<div class="form-group">
								<label for="publisher">Penerbit</label>
								<p id="publisher">{{ $book->publisher->name }}</p>
							</div>

							{{-- stock --}}
							<div class="form-group">
								<label for="status">Stok</label>
								<p>{{ $book->stock }}</p>
							</div>

							{{-- rental price --}}
							<div class="form-group">
								<label for="status">Biaya Sewa</label>
								<p>{{ formatRp($book->rental_price, 2) }}</p>
							</div>
						</div>
					</div>
					{{-- /.book data --}}
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

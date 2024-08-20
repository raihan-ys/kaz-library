@extends('layouts.app')

@section('page-header')
<div class="row">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					{{-- page title --}}
					<div class="col-sm-6">
						<h1>Edit Buku</h1>
					</div>
					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('buku.index') }}">
									<i class="fas fa-book"></i>
									Buku
								</a>
							</li>
							<li class="breadcrumb-item active">
								Edit Buku: {{ $book->title }}
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
	<div class="card">
		{{-- header --}}
		<div class="card-header">
			<h5>Form Edit Buku</h5>
		</div>
		<form action="{{ route('buku.update', $book->id) }}" method="post">
			{{-- body --}}
			<div class="card-body">
				@csrf
				@method('PUT')
		
				{{-- id --}}
				<input type="hidden" name="id" value="{{ $book->id }}">
				<div class="form-row">
					{{-- title --}}
					<div class="form-group col-md-6">
						<label for="title">Judul</label>
						<input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" placeholder="Masukkan Judul Buku" maxlength="100" required>
					</div>
					{{-- author --}}
					<div class="form-group col-md-6">
						<label for="author">Penulis</label>
						<input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" placeholder="Masukkan Nama Penulis" maxlength="100" required>
					</div>
				</div>
				<div class="form-row">
					{{-- isbn --}}
					<div class="form-group col-md-6">
						<label for="isbn">ISBN</label>
						<input type="number" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" placeholder="Masukkan ISBN Buku" required>
					</div>
					{{-- published year --}}
					<div class="form-group col-md-6">
						<label for="published_year">Tahun Terbit</label>
						<input type="number" class="form-control" id="published_year" name="published_year" value="{{ $book->published_year }}" placeholder="Masukkan Tahun Penerbitan Buku" required>
					</div>
				</div>
				<div class="form-row">
					{{-- category --}}
					<div class="form-group col-md-6">
						<label for="category_id">Kategori</label>
						<select class="form-control" id="category_id" name="category_id" required>
							@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ $category->id === $book->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
					{{-- publisher --}}
					<div class="form-group col-md-6">
						<label for="publisher_id">Penerbit</label>
						<select class="form-control" id="publisher_id" name="publisher_id" required>
							@foreach($publishers as $publisher)
							<option value="{{ $publisher->id }}" {{ $publisher->id === $book->publisher_id ? 'selected' : '' }}>{{ $publisher->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					{{-- stock --}}
					<div class="form-group col-md-6">
						<label for="stock">Stok</label>
						<input type="number" class="form-control" id="stock" name="stock" value="{{ $book->stock }}">
					</div>
					{{-- rental price --}}
					<div class="form-group col-md-6">
						<label for="rental_price">Biaya Peminjaman</label>
						<input type="number" class="form-control" id="rental_price" name="rental_price" value="{{ $book->rental_price }}">
					</div>
				</div>
				{{-- cover image --}}
				<div class="form-group">
					<label for="cover_image">Gambar Sampul</label>
					<input type="text" class="form-control" id="cover_image" name="cover_image" value="{{ $book->cover_image }}">
				</div>
			</div>
			{{-- footer --}}
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<a href="{{ route('buku.index') }}" class="btn btn-secondary">
					<i class="fas fa-arrow-left"></i>
					Kembali
				</a>
			</div>
		</form>
	</div>
</div>
@endsection

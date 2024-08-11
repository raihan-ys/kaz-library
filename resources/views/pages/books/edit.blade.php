@extends('layouts.app')
@section('content')
<div class="container">
	<h1><i class="fas fa-book"></i> Edit Buku</h1>
 	<form action="{{ route('buku.update', $book->id) }}" method="post">
		@csrf
		@method('put')

		<input type="hidden" name="id" value="{{ $book->id }}">
		<div class="form-row">
			{{-- title --}}
			<div class="form-group col-md-6">
				<label for="title">Judul</label>
				<input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
			</div>
			{{-- author --}}
			<div class="form-group col-md-6">
				<label for="author">Penulis</label>
				<input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
			</div>
		</div>

		<div class="form-row">
			{{-- published year --}}
			<div class="form-group col-md-6">
				<label for="published_year">Tahun Terbit</label>
				<input type="number" class="form-control" id="published_year" name="published_year" value="{{ $book->published_year }}" required>
			</div>
			{{-- category --}}
			<div class="form-group col-md-6">
				<label for="category_id">Kategori</label>
				<select class="form-control" id="category_id" name="category_id" required>
					@foreach($categories as $category)
					<option value="{{ $category->id }}" {{ $category->id === $book->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-row">
			{{-- publisher --}}
			<div class="form-group col-md-6">
				<label for="publisher_id">Penerbit</label>
				<select class="form-control" id="publisher_id" name="publisher_id" required>
 					@foreach($publishers as $publisher)
					 <option value="{{ $publisher->id }}" {{ $publisher->id === $book->publisher_id ? 'selected' : '' }}>{{ $publisher->name }}</option>
					@endforeach
				</select>
			</div>
			{{-- cover image --}}
			<div class="form-group col-md-6">
				<label for="cover_image">Gambar Sampul</label>
				<input type="text" class="form-control" id="cover_image" name="cover_image" value="{{ $book->cover_image }}">
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

		{{-- submit --}}
		<button type="submit" class="btn btn-primary">Edit</button>
		<a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
	</form>
</div>
@endsection

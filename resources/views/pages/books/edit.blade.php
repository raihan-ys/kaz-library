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
								<a href="{{ route('buku') }}">
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
		<div class="card-header" style="border-top: #181C32 solid 5px">
			<h5 class="font-weight-bold">Form Edit Buku</h5>
		</div>

		<form action="{{ route('buku.update', $book->id) }}" method="post">
			{{-- body --}}
			<div class="card-body">

				{{-- error messages --}}
				@if($errors->any())
				<div class="alert mt-1" style="background-color: red">
					<span class="float-right text-white" id="closeAlert" style="cursor: pointer">&times;</span>
					<strong class="text-white">
						<i class="fas fa-exclamation-triangle"></i> 
						Terjadi Kesalahan
					</strong><hr>
					<ul>
						@foreach($errors->all() as $error)
						<li class="text-white">{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				{{-- /.error messages --}}

				@csrf
				@method('PUT')
		
				{{-- id --}}
				<input type="hidden" name="id" value="{{ $book->id }}">

				{{-- title --}}
				<div class="form-group">
					<label for="title">Judul</label>
					<input type="text" class="form-control {{ $errors->has('title') ? 'bg-danger text-white' : '' }}" id="title" name="title" value="{{ null !== old('title') ? old('title') : $book->title }}" placeholder="Masukkan Judul Buku" maxlength="100" required>
					@if($errors->has('title'))
					{{-- error message --}}
					<span class="text-danger">
						{{ $errors->first('title') }}
					</span>
					@endif
				</div>

				{{-- author --}}
				<div class="form-group">
					<label for="author">Penulis</label>
					<input type="text" class="form-control {{ $errors->has('author') ? 'bg-danger text-white' : '' }}" id="author" name="author" value="{{ null !== old('author') ? old('author') : $book->author }}" placeholder="Masukkan Nama Penulis" maxlength="100" required>
					@if($errors->has('author'))
					{{-- error message --}}
					<span class="text-danger">
						{{ $errors->first('author') }}
					</span>
					@endif
				</div>
			
				<div class="form-row">
					{{-- isbn --}}
					<div class="form-group col-md-6">
						<label for="isbn">ISBN</label>
						<input type="number" class="form-control {{ $errors->has('isbn') ? 'bg-danger text-white' : '' }}" id="isbn" name="isbn" value="{{ null !== old('isbn') ? old('isbn') : $book->isbn }}" placeholder="Masukkan ISBN Buku" required>
						@if($errors->has('isbn'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('isbn') }}
						</span>
						@endif
					</div>
					{{-- published year --}}
					<div class="form-group col-md-6">
						<label for="published_year">Tahun Terbit</label>
						<input type="number" class="form-control {{ $errors->has('published_year') ? 'bg-danger text-white' : '' }}" id="published_year" name="published_year" value="{{ null !== old('published_year') ? old('published_year') : $book->published_year }}" placeholder="Masukkan Tahun Penerbitan Buku" required>
						@if($errors->has('published_year'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('published_year') }}
						</span>
						@endif
					</div>
				</div>

				<div class="form-row">
					{{-- category --}}
					<div class="form-group col-md-6">
						<label for="category_id">Kategori</label>
						<select class="form-control {{ $errors->has('category_id') ? 'bg-danger text-white' : '' }}" id="category_id" name="category_id" required>
							@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ $category->id === $book->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
							@endforeach
						</select>
						@if($errors->has('category_id'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('category_id') }}
						</span>
						@endif
					</div>
					{{-- publisher --}}
					<div class="form-group col-md-6">
						<label for="publisher_id">Penerbit</label>
						<select class="form-control {{ $errors->has('publisher_id') ? 'bg-danger text-white' : '' }}" id="publisher_id" name="publisher_id" required>
							@foreach($publishers as $publisher)
							<option value="{{ $publisher->id }}" {{ $publisher->id === $book->publisher_id ? 'selected' : '' }}>{{ $publisher->name }}</option>
							@endforeach
						</select>
						@if($errors->has('publisher_id'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('publisher_id') }}
						</span>
						@endif
					</div>
				</div>

				<div class="form-row">
					{{-- stock --}}
					<div class="form-group col-md-6">
						<label for="stock">Stok</label>
						<input type="number" class="form-control {{ $errors->has('stock') ? 'bg-danger text-white' : '' }}" id="stock" name="stock" value="{{ $book->stock }}">
						@if($errors->has('stock'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('stock') }}
						</span>
						@endif
					</div>
					{{-- rental price --}}
					<div class="form-group col-md-6">
						<label for="rental_price">Biaya Peminjaman</label>
						<input type="number" class="form-control {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" id="rental_price" name="rental_price" value="{{ $book->rental_price }}">
						@if($errors->has('rental_price'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('rental_price') }}
						</span>
						@endif
					</div>
				</div>
				
				{{-- cover image --}}
				<div class="form-group">
					<label for="cover_image">Gambar Sampul</label>
					<input type="text" class="form-control {{ $errors->has('cover_image') ? 'bg-danger text-white' : '' }}" id="cover_image" name="cover_image" value="{{ $book->cover_image }}">
					@if($errors->has('cover_image'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('cover_image') }}
						</span>
						@endif
				</div>
			</div>
			
			{{-- footer --}}
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i>
					Simpan
				</button>
				<a href="{{ route('buku') }}" class="btn btn-secondary">
					<i class="fas fa-arrow-left"></i>
					Kembali
				</a>
			</div>
		</form>
	</div>
</div>
@endsection

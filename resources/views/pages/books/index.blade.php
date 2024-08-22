@extends('layouts.app')

@section('page-header')
<div class="row">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Buku</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card" style="border-top: #181C32 solid 5px">
				{{-- header --}}
				<div class="card-header">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBookModal">
						<i class="fas fa-plus mr-1"></i>Tambah Buku
					</button>

					{{-- create book modal --}}
					<div class="modal fade" id="createBookModal">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								{{-- header --}}
								<div class="modal-header">
									<h4 class="modal-title font-weight-bold">Form Tambah Buku</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<form id="createBookForm" action="{{ route('buku.store') }}" method="post">
									{{-- body --}}
									<div class="modal-body" action="{{ route('buku.create') }}" method="post">
										@csrf
						
										{{-- title --}}
										<div class="form-group">
											<label for="title">Judul</label>
											<input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Judul Buku" maxlength="100" value="{{ old('title') }}" required>
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
											<input type="text" name="author" id="author" class="form-control {{ $errors->has('author') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Nama Penulis" maxlength="100" value="{{ old('author') }}" required>
											@if($errors->has('author'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('author') }}
											</span>
											@endif
										</div>
										
										<div class="form-row">
											{{-- isbn --}}
											<div class="col-md-6 mb-3">
												<label for="isbn">ISBN</label>
												<input type="text" name="isbn" id="isbn" class="form-control {{ $errors->has('isbn') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan ISBN Buku" maxlength="20" value="{{ old('isbn') }}" required>
												@if($errors->has('isbn'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('isbn') }}
												</span>
												@endif
											</div>
											{{-- published year --}}
											<div class="col-md-6 mb-3">
												<label for="published_year">Tahun Terbit</label>
												<input type="number" name="published_year" id="published_year" class="form-control {{ $errors->has('published_year') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Tahun Penerbitan Buku" value="{{ old('published_year') }}" required>
												@if($errors->has('published_year'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('published_year') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-row">
											{{-- category id --}}
											<div class="col-md-6 mb-3">
												<label for="category_id">Kategori</label>
												<select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? 'bg-danger text-white' : '' }}" required>
													<option selected disabled hidden>- Pilih Kategori -</option>
													@foreach($categories as $category)
													<option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
													@endforeach
												</select>
												@if($errors->has('category_id'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('category_id') }}
												</span>
												@endif
											</div>
											{{-- publisher id --}}
											<div class="col-md-6 mb-3">
												<label for="publisher_id">Penerbit</label>
												<select name="publisher_id" id="publisher_id" class="form-control {{ $errors->has('publisher_id') ? 'bg-danger text-white' : '' }}" required>
													<option selected disabled hidden>- Pilih Penerbit -</option>
													@foreach($publishers as $publisher)
													<option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
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
											<div class="col-md-6 mb-3">
												<label for="stock">Stok</label>
												<input type="number" name="stock" id="stock" class="form-control {{ $errors->has('stock') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Jumlah Stok Buku" min="0" max="99" value="{{ old('stock') }}" required>
												@if($errors->has('stock'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('stock') }}
												</span>
												@endif
											</div>
											{{-- rental price --}}
											<div class="col-md-6 mb-3">
												<label for="rental_price">Harga Sewa</label>
												<input type="number" name="rental_price" id="rental_price" class="form-control {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Harga Sewa Buku" min="0" max="99999" value="{{ old('rental_price') }}" required>
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
											<input type="text" class="form-control {{ $errors->has('cover_image') ? 'bg-danger text-white' : '' }}" name="cover_image" id="cover_image" value="{{ old('cover_image') }}">
											@if($errors->has('cover_image'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('cover_image') }}
												</span>
												@endif
										</div>
									</div>
									{{-- /.body --}}

									{{-- footer --}}
									<div class="modal-footer justify-content-between btn-group">
										<button type="button" class="btn btn-outline-secondary" id="closeModal" data-dismiss="modal">Batal</button>
										<button type="reset" class="btn btn-outline-info">Reset</button>
										<button type="submit" class="btn btn-outline-primary" id="createBook">Simpan</button>
									</div>
								</form>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					{{-- /.create book modal --}}

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
				</div>
				{{-- /.header --}}

				{{-- body --}}
				<div class="card-body table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Judul</th>
								<th scope="col">ISBN</th>
								<th scope="col">Penulis</th>
								<th scope="col">Tahun Terbit</th>
								<th scope="col">Kategori</th>
								<th scope="col">Penerbit</th>
								<th scope="col">Stok</th>
								<th scope="col">Harga Sewa</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php($i = 1)
							@foreach ($books as $book)
							<tr>
								<td>{{ $i++ }}</td>
								<td class="font-weight-bold">{{ $book->title }}</td>
								<td>{{ $book->isbn }}</td>
								<td>{{ $book->author }}</td>
								<td>{{ $book->published_year }}</td>
								<td>{{ $book->category->name }}</td>
								<td>{{ $book->publisher->name }}</td>
								<td>{{ $book->stock }}</td>
								<td>{{ $book->rental_price }}</td>
								<td>
									{{-- show --}}
									<a href="{{ route('buku.show', $book->id) }}" class="btn btn-info" title="Detail Buku">
										<i class="fas fa-eye"></i>
									</a>
									{{-- update --}}
									<a href="{{ route('buku.edit', $book->id) }}" class="btn btn-warning" title="Edit">
										<i class="fas fa-edit"></i>
									</a>
									{{-- delete --}}
									<form class="delete_form" action="{{ route('buku.destroy', $book->id) }}" method="post" style="display:inline">
										@csrf
										@method('DELETE')
										<button type="submit" class="delete_submit btn btn-danger" title="Hapus">
											<i class="fas fa-trash"></i>
										</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{-- /.body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.col --}}
	</div>
	{{-- /.row --}}
</div>
@endsection

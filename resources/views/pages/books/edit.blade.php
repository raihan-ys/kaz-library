@extends('layouts.app')
@section('title', 'Edit Buku - Kaz-Library')
@section('page-header')
<div class="row m-0">
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
								Edit
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

		<form id="editBookForm" action="{{ route('buku.update', $book->id) }}" method="post" enctype="multipart/form-data">
			{{-- body --}}
			<div class="card-body">

				{{-- error messages --}}
				@if($errors->any())
				<div class="alert mt-1" style="background-color: red">
					<span class="float-right text-white" id="closeAlert" style="cursor: pointer">&times;</span>
					<strong class="text-white">
						<i class="fas fa-exclamation-triangle"></i> 
						Terjadi Kesalahan!
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
					<input type="text" class="form-control {{ $errors->has('author') ? 'bg-danger text-white' : '' }}" id="author" name="author" value="{{ old('author', $book->author) }}" placeholder="Masukkan Nama Penulis" maxlength="100" required>
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
						<input type="number" class="form-control {{ $errors->has('isbn') ? 'bg-danger text-white' : '' }}" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" placeholder="Masukkan ISBN Buku" required>
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
				
				<!-- cover image -->
				<div class="col-12">
											
					{{-- file input --}}
					<div class="form-group">
						<label for="cover_image">Gambar Sampul</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="cover_image" name="cover_image" accept=".png" value="{{ old('cover_image', $book->cover_image) }}">
								<label class="custom-file-label {{ $errors->has('cover_image') ? 'bg-danger text-white' : '' }}" for="cover_image">Pilih gambar PNG</label>
							</div>
							<div class="input-group-append">
								<span class="input-group-text" id="uploadButton">Unggah</span>
							</div>
						</div>
						{{-- cancel upload --}}
						<button type="button" class="btn btn-danger mt-2 {{ $book->cover_image ? '' : 'd-none' }}" id="cancelUpload">
							<i class="fas fa-trash"></i>
							Batalkan Pilihan
						</button>
						{{-- error message --}}
						@if ($errors->has('cover_image'))
						<div class="text-danger">
							{{ $errors->first('cover_image') }}
						</div>
						@endif
					</div>
					{{-- /.file input --}}

					{{-- image preview --}}
					<div class="row" id="previewContainer">
						<div class="col-3" id="imageContainer">
							<label for="coverPreview">Pratinjau Sampul</label>
							<img id="coverPreview" src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : asset('images/sample-book-cover.png') }}" alt="Image Preview" class="img-fluid"/>
						</div>

						{{-- Metadata from previous file --}}
						@if(session('file_metadata'))
						<div class="alert alert-danger">
							<strong>File Metadata:</strong>
							<ul>
								<li>Nama File: {{ session('file_metadata.name') }}</li>
								<li>Ukuran File: {{ session('file_metadata.size') }} bytes</li>
								<li>Jenis File: {{ session('file_metadata.type') }}</li>
							</ul>
						</div>
						@endif

						{{-- Current file metadata --}}
						<div class="col-9">
							<ul id="coverMetadata" class="list-unstyled mt-4">
								<li><span id="fileName"></span></li>
								<li><span id="fileSize"></span></li>
								<li><span id="fileType"></span></li>
							</ul>
							<div class="text-danger d-none" id="fileError">
								File terlalu besar, maksimal ukuran 1 MB.
							</div>
							<div class="text-danger d-none" id="fileError2">
								File melebihi ukuran 2 MB, tidak dapat diunggah.
							</div>
						</div>
					</div>
					{{-- /.image preview --}}
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

@section('js')
<script>
	$(document).ready(function() {
		// Change title field colors.
		$('#title').change(function(e) {
			$("#title").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change author field colors.
		$('#author').change(function(e) {
			$("#author").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change isbn field colors.
		$('#isbn').change(function(e) {
			$("#isbn").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change published year field colors.
		$('#published_year').change(function(e) {
			$("#published_year").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change category id field colors.
		$('#category_id').change(function(e) {
			$("#category_id").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change publisher id field colors.
		$('#publisher_id').change(function(e) {
			$("#publisher_id").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change stock field colors.
		$('#stock').change(function(e) {
			$("#stock").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change rental price colors.
		$('#rental_price').change(function(e) {
			$("#rental_price").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// File input change event.
		let canSubmit = true;
		$('#cover_image').change(function(e) {
			// Get uploaded file.
			const file = e.target.files[0];
			if(file) {
				// Maximum file size in bytes (1 MB).
				const maxSizeBytes = 1048576;

				// Read the file.
				const reader = new FileReader();
				reader.onload = function(e) {
					// Set image preview.
					$("#coverPreview").attr('src', e.target.result);

					// Show the preview container.
					$("#previewContainer").removeClass('d-none');
					$("#cancelUpload").removeClass('d-none');
				}

				// Read the file as a data URL.
				reader.readAsDataURL(file);

				// Update the label with the file name.
				$(this).next('.custom-file-label').html(file.name);
							
				// Update metadata information.
				$('#fileName').text(file.name);

				// Check if file size exceeds the limit.
				if (file.size > maxSizeBytes) {
					// Display size in MB if file is too large.
					const fileSizeMB = (file.size / maxSizeBytes).toFixed(2);
					$('#fileSize').text(fileSizeMB + ' MB');

					// If file is larger than 2 MB.
					if (file.size > 2048576) {
						// Change the file input field color.
						$('.custom-file-label').addClass('bg-danger text-white');

						// Hide image preview.
						$('#imageContainer').addClass('d-none');
						$('#coverMetadata').removeClass('mt-4');

						// Show error message.
						$('#fileError').addClass('d-none');
						$('#fileError2').removeClass('d-none');

						canSubmit = false;
					}
				} else {
					// Reset the file input field color.
					$('.custom-file-label').removeClass('bg-danger text-white');

					// Display size in KB if it's within the limit.
					$('#fileSize').text((file.size / 1024).toFixed(2) + ' KB');

					// Hide error message.
					$('#fileError').addClass('d-none');
					$('#fileError2').addClass('d-none');

					// Display preview.
					$('#imageContainer').removeClass('d-none');

					$('#coverMetadata').addClass('mt-4');

					canSubmit = true;
				}
				// Display file type.
				$('#fileType').text(file.type);

				// Prevent form submission based on the flag.
				$('#editBookForm').submit(function(e) {
					if (!canSubmit) {
						e.preventDefault();
						return alert('Gambar sampul belum diunggah dengan benar!');
					}
				});
			} else {	
				// Reset file input label.
				$(this).next('.custom-file-label').html('Pilih gambar');

				// Clear metadata information.
				$('#fileName, #fileSize, #fileType').text('');
			}
		});

		// Reset file input.
		$('#cancelUpload').click(function() {

			$('#cover_image').val('');

			// Reset file input label.
			$('.custom-file-label').removeClass('bg-danger text-white');
			$('.custom-file-label').html('Pilih gambar PNG');

			// Reset preview image.
			$('#previewContainer').addClass('d-none');

			// Hide any error messages.
			$('#fileError').addClass('d-none');
			$('#fileError2').addClass('d-none');

			// Clear metadata information
			$('#fileName').text('');
			$('#fileSize').text('');
			$('#fileType').text('');

			// Hide the cancel button.
			$('#cancelUpload').addClass('d-none');
		});
	});
</script>
@endsection

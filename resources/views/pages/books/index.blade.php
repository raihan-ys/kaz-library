@extends('layouts.app')
@section('title', 'Daftar Buku - Kaz-Library')
@section('page-header')
<div class="row m-0">
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

								<form id="createBookForm" action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
									{{-- body --}}
									<div class="modal-body">
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
										
										<!-- cover image -->
										<div class="col-12">
											
											{{-- file input --}}
											<div class="form-group">
												<label for="cover_image">Gambar Sampul</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="cover_image" name="cover_image" accept=".png">
														<label class="custom-file-label {{ $errors->has('cover_image') ? 'bg-danger text-white' : '' }}" for="cover_image">Pilih gambar PNG</label>
													</div>
													<div class="input-group-append">
														<span class="input-group-text" id="uploadButton">Unggah</span>
													</div>
												</div>
												{{-- cancel upload --}}
												<button type="button" class="btn btn-danger d-none mt-2" id="cancelUpload">
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
											<div class="row d-none" id="previewContainer">
												<div class="col-3" id="imageContainer">
													<label for="coverPreview">Pratinjau Sampul</label><br>
													<img id="coverPreview" src="#" alt="Book's Cover Image Preview" class="img-fluid"/>
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
												</div>
												<div class="text-danger d-none" id="fileError">
													File terlalu besar, maksimal ukuran 1 MB.
												</div>
												<div class="text-danger d-none" id="fileError2">
													File melebihi ukuran 2 MB, tidak dapat diunggah.
												</div>
											</div>
											{{-- /.image preview --}}
										</div>
									</div>
									{{-- /.body --}}

									{{-- footer --}}
									<div class="modal-footer justify-content-between btn-group">
										<button type="button" id="resetButton" class="btn btn-outline-danger">Reset</button>
										<button type="submit" class="btn btn-outline-primary" id="createBook">Simpan</button>
									</div>
								</form>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					{{-- /.create book modal --}}

					{{-- success message --}}
					@if(session('success'))
					<div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
						{{-- toast header --}}
						<div class="toast-header" style="font-size: 20px;">
							<i class="fas fa-check mr-1"></i>
							<strong class="mr-auto">Sukses!</strong>
							<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						{{-- toast body --}}
						<div class="toast-body" style="font-size: 15px">
							{{ session('success') }}
						</div>
					</div>
					<script>
						$(document).ready(function(){
							$('.toast').toast({ delay: 5000 });
							$('.toast').toast('show');
						});
					</script>
					@endif

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
				</div>
				{{-- /.header --}}

				{{-- body --}}
				<div class="card-body table-responsive">
					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="booksTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Judul</th>
								<th scope="col">Penulis</th>
								<th scope="col">ISBN</th>
								<th scope="col">Tahun Terbit</th>
								<th scope="col">Kategori</th>
								<th scope="col">Penerbit</th>
								<th scope="col">Stok</th>
								<th scope="col">Biaya Sewa</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($books as $book)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $book->title }}</td>
								<td>{{ $book->author }}</td>
								<td>{{ $book->isbn }}</td>
								<td>{{ $book->published_year }}</td>
								<td>{{ $book->category_name }}</td>
								<td>{{ $book->publisher_name }}</td>
								<td>{{ $book->stock }}</td>
								<td>Rp.{{ number_format($book->rental_price, 0, ',', '.') }}</td>
								<td>
									<div class="btn-group">
										{{-- show --}}
										<a href="{{ route('buku.show', $book->id) }}" class="btn btn-info" title="Detail Buku">
											<i class="fas fa-eye"></i>
										</a>
										{{-- update --}}
										<a href="{{ route('buku.edit', $book->id) }}" class="btn btn-warning" title="Edit">
											<i class="fas fa-edit"></i>
										</a>
										{{-- delete --}}
										<button type="submit" class="btn btn-danger" data-book-id="{{ $book->id }}" title="Hapus" onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}', '{{ $book->cover_image ? asset('storage/'.$book->cover_image) : asset('images/sample-book-cover.png') }}')">
											<i class="fas fa-trash"></i>
										</button>
										<form id="delete-form-{{ $book->id }}" action="{{ route('buku.destroy', $book->id) }}" method="post" style="display:inline">
											@csrf
											@method('DELETE')
										</form>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="10" class="text-center font-weight-bold text-danger py-5">Tidak ada data buku!</td>
							</tr>
							@endforelse
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

@section('js')
<script>
	// Book delete confirmation.
	function confirmDelete(bookId, bookTitle, bookCover) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			imageUrl: bookCover,
			imageWidth: 200,
			imageHeight: 300,
			html: 'Setelah dihapus, Anda tidak dapat memulihkan buku <b>"' + bookTitle + '"</b>! <span class="text-danger">Data penyewaan buku ini juga akan dihapus!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit book's delete form.
				document.getElementById('delete-form-' + bookId).submit();
			}
		});
	};

	$(document).ready(function(){
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

					// Show the preview container and cancel button.
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
					const fileSizeMB = (file.size / maxSizeBytes).toFixed(2); // Rounded.	
					$('#fileSize').text(fileSizeMB + ' MB');

					// Change the file input field color.
					$('.custom-file-label').removeClass('bg-danger text-white');

					// Display image preview.
					$('#imageContainer').removeClass('d-none');
					$('#coverMetadata').addClass('mt-4');

					// Show error message.
					$("#fileError").removeClass('d-none');
					$('#fileError2').addClass('d-none');

					canSubmit = true;

					// If file is larger than 2 MB.
					if (file.size > (2048576)) {
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
				$('#createBookForm').submit(function(e) {
					if (!canSubmit) {
						e.preventDefault();
						return alert('Gambar sampul belum diunggah dengan benar!');
					}
				});
			} else {
				// If no file is selected, hide preview and error message, reset label and metadata.
				$('#previewContainer').addClass('d-none');
				$('#fileError').addClass('d-none');
							
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

		// Reset all input fields
		$('#resetButton').click(function() {
			// Title.
			$("#title").val('');
			$("#title").removeClass('bg-danger text-white');
			$("#title").next('.text-danger').addClass('d-none');

			// Author.
			$("#author").val('');
			$("#author").removeClass('bg-danger text-white');
			$("#author").next('.text-danger').addClass('d-none');

			// ISBN.
			$("#isbn").val('');
			$("#isbn").removeClass('bg-danger text-white');
			$("#isbn").next('.text-danger').addClass('d-none');

			// Published year.
			$("#published_year").val('');
			$("#published_year").removeClass('bg-danger text-white');
			$("#published_year").next('.text-danger').addClass('d-none');

			// Stock.
			$("#stock").val('');
			$("#stock").removeClass('bg-danger text-white');
			$("#stock").next('.text-danger').addClass('d-none');

			// Rental price.
			$("#rental_price").val('');
			$("#rental_price").removeClass('bg-danger text-white');
			$("#rental_price").next('.text-danger').addClass('d-none');

			// Cover image.
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

		// Initialize DataTables to books table.
		$('#booksTable').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy',
				'csv',
				'excel',
				'print',
			]
		});
	});
	</script>
@endsection

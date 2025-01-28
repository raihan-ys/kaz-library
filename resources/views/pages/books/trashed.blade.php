@extends('layouts.app')
@section('title', 'Buku Terhapus - Kaz-Library')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Buku Terhapus</h1>
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
								Buku Terhapus
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
		<div class="col-12">
			<div class="card" style="border-top: #181C32 solid 5px">

				{{-- header --}}
				@if($errors->any())
				<div class="card-header">
					{{-- error messages --}}
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
					{{-- /.error messages --}}
				</div>
				@endif
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
								<td>{{ formatRp($book->rental_price, 2) }}</td>
								<td>
									<div class="btn-group">
										{{-- restore --}}
										<a href="{{ route('buku.restore', $book->id) }}" class="btn btn-success" title="Pulihkan" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $book->id }}').submit();">
											<i class="fas fa-undo"></i>
										</a>
										<form method="POST" class="d-none" id="restore-form-{{ $book->id }}" action="{{ route('buku.restore', $book->id) }}">
											@csrf
										</form>
										{{-- force delete --}}
										<button type="submit" class="btn btn-danger" data-book-id="{{ $book->id }}" title="Hapus Permanen" onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}', '{{ $book->cover_image ? asset('storage/'.$book->cover_image) : asset('images/sample-book-cover.png') }}')">
											<i class="fas fa-trash"></i>
										<form id="force-delete-form-{{ $book->id }}" action="{{ route('buku.force-delete', $book->id) }}" method="POST" class="d-none">
											@csrf
											@method('DELETE')
										</button>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="10" class="text-center font-weight-bold text-danger py-5">Tidak ada buku terhapus!</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				{{-- /.body --}}

				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('buku') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
				</div>
				{{-- /.footer --}}
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
	// Book force delete confirmation.
	function confirmDelete(bookId, bookTitle, bookCover) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			imageUrl: bookCover,
			imageWidth: 200,
			imageHeight: 300,
			html: '<span class="text-danger">Setelah dihapus, Anda tidak dapat memulihkan buku <b>"' + bookTitle + '"</b>!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus permanen!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit book's delete form.
				document.getElementById('force-delete-form-' + bookId).submit();
			}
		});
	};

	$(document).ready(function(){
		// Initialize DataTables to books table.
		$('#booksTable').DataTable({
			dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
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

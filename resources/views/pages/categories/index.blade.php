@extends('layouts.app')
@section('title', 'Daftar Kategori')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Kategori Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Kategori</li>
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

					{{-- soft deleted categories button --}}
					<a href="{{ route('kategori.trashed') }}" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i>
						Kategori Terhapus
					</a>

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

				{{-- body --}}
				<div class="card-body table-responsive">

					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="categoriesTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kategori</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($categories as $ctg)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $ctg->name }}</td>
								<td>
									{{-- delete --}}
									<button type="submit" class="btn btn-danger" data-ctg-id="{{ $ctg->id }}" title="Hapus" onclick="confirmDelete({{ $ctg->id }}, '{{ $ctg->name }}')">
										<i class="fas fa-trash"></i>
									</button>
									<form id="delete-form-{{ $ctg->id }}" action="{{ route('kategori.destroy', $ctg->id) }}" method="post" style="display:inline">
										@csrf
										@method('DELETE')
									</form>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="9" class="text-center font-weight-bold text-danger py-5">Tidak ada kategori buku!</td>
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
	// Category delete confirmation.
	function confirmDelete(ctgId, ctgName) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			html: 'Kategori <b>"' + ctgName + '"</b> akan dihapus dari tabel ini! <span class="text-danger">Buku serta penyewaan dengan kategori ini juga akan dihapus!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit category's delete form.
				document.getElementById('delete-form-' + ctgId).submit();
			}
		})
	};

	$(document).ready(function() {
		// Initialize DataTables to categories table.
		$('#categoriesTable').DataTable({
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

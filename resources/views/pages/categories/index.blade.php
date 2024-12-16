@extends('layouts.app')
@section('title', 'Daftar Kategori - Kaz-Library')
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
				{{-- body --}}
				<div class="card-body table-responsive">

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

					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="categoriesTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kategori</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $ctg)
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
@section('js')
<script>
	// Category delete confirmation.
	function confirmDelete(ctgId, ctgName) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			html: 'Setelah dihapus, Anda tidak dapat memulihkan kategori <b>"' + ctgName + '"</b>! <span class="text-danger">Data buku dengan kategori ini juga akan dihapus!</span>',
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
		$('#categoriesTable').DataTable();
	});
</script>
@endsection

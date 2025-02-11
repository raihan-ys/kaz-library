@extends('layouts.app')
@section('title', 'Kategori Terhapus')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Kategori Terhapus</h1>
					</div>
					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('kategori') }}">
									<i class="fas fa-book"></i>
									Kategori
								</a>
							</li>
							<li class="breadcrumb-item active">
								Kategori Terhapus
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
									{{-- restore --}}
									<a href="{{ route('kategori.restore', $ctg->id) }}" class="btn btn-success" title="Pulihkan" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $ctg->id }}').submit();">
										<i class="fas fa-undo"></i>
									</a>
									<form method="POST" class="d-none" id="restore-form-{{ $ctg->id }}" action="{{ route('kategori.restore', $ctg->id) }}">
										@csrf
									</form>
									{{-- force delete --}}
									<button type="submit" class="btn btn-danger" data-ctg-id="{{ $ctg->id }}" title="Hapus Permanen" onclick="confirmForceDelete({{ $ctg->id }}, '{{ $ctg->name }}')">
										<i class="fas fa-trash"></i>
									</button>
									<form class="d-none" id="force-delete-form-{{ $ctg->id }}" action="{{ route('kategori.force-delete', $ctg->id) }}" method="post">
										@csrf
										@method('DELETE')
									</form>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="9" class="text-center font-weight-bold text-danger py-5">Tidak ada kategori terhapus!</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				{{-- /.body --}}

				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('kategori') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
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
	// Category force delete confirmation.
	function confirmForceDelete(ctgId, ctgName) {
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
		html: '<span class="text-danger">Setelah dihapus, Anda tidak dapat memulihkan kategori <b>"' + ctgName + '"</b>!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus permanen!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				document.getElementById('force-delete-form-' + ctgId).submit();
			}
		})
  }

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

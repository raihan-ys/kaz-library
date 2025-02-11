@extends('layouts.app')
@section('title', 'Daftar Penerbit')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Penerbit Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Penerbit</li>
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
					{{-- soft deleted publishers button --}}
					<a href="{{ route('penerbit.trashed') }}" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i> Penerbit Terhapus
					</a>
				</div>
				{{-- body --}}
				<div class="card-body table-responsive">

					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="publishersTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Penerbit</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($publishers as $pbs)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $pbs->name }}</td>
								<td>
									{{-- delete --}}
									<button type="submit" class=" btn btn-danger" data-pbs-id="{{ $pbs->id }}" title="Hapus" onclick="confirmDelete({{ $pbs->id }}, '{{ $pbs->name }}')">
										<i class="fas fa-trash"></i>
									</button>
									<form id="delete-form-{{ $pbs->id }}" action="{{ route('penerbit.destroy', $pbs->id) }}" method="post" style="display:inline">
										@csrf
										@method('DELETE')
									</form>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="9" class="text-center font-weight-bold text-danger py-5">Tidak ada penerbit buku!</td>
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
	// Publisher delete confirmation.
	function confirmDelete(pbsId, pbsName) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			html: 'Setelah dihapus, Anda tidak dapat memulihkan penerbit <b>"' + pbsName + '"</b>! <span class="text-danger">Buku dengan penerbit ini juga akan dihapus!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit publisher's delete form.
				document.getElementById('delete-form-' + pbsId).submit();
			}
		})
	}

	$(document).ready(function() {
		// Initialize DataTables to publishers table.
		$('#publishersTable').DataTable({
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

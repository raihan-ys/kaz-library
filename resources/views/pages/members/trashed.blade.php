@extends('layouts.app')
@section('title', 'Anggota Terhapus - Kaz-Library')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Anggota Terhapus</h1>
					</div>
					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('anggota') }}">
									<i class="fas fa-users"></i>
									Anggota
								</a>
							</li>
							<li class="breadcrumb-item active">
								Anggota Terhapus
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
					<div class="alert mt-1" style="background-color: red">
						<span class="float-right text-white" id="closeAlert" style="cursor: pointer">&times;</span>
						<strong class="text-white">
							<i class="fas fa-exclamation-triangle"></i> 
							Terjadi Kesalahan!
						</strong><hr class="bg-white">
						<ul>
							@foreach($errors->all() as $error)
							<li class="text-white">{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
				@endif
				{{-- /.header --}}

				{{-- body --}}
				<div class="card-body table-responsive">
					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="membersTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Tipe</th>
								<th scope="col">Alamat</th>
								<th scope="col">No. Telepon</th>
								<th scope="col">Email</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($members as $member)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $member->full_name }}</td>
								<td>{{ $member->type_name }}</td>
								<td>{{ $member->address }}</td>
								<td>{{ $member->phone }}</td>
								<td>{{ $member->email }}</td>
								<td>
									<div class="btn-group">
										{{-- restore --}}
										<a href="{{ route('anggota.restore', $member->id) }}" class="btn btn-success" title="Pulihkan" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $member->id }}').submit();">
											<i class="fas fa-undo"></i>
										</a>
										<form method="POST" class="d-none" id="restore-form-{{ $member->id }}" action="{{ route('anggota.restore', $member->id) }}">
											@csrf
										</form>
										{{-- force delete --}}
										<button type="submit" class="btn btn-danger" data-member-id="{{ $member->id }}" title="Hapus Permanen" onclick="confirmDelete({{ $member->id }}, '{{ $member->full_name }}', '{{ $member->profile_photo ? asset('storage/'.$member->profile_photo) : asset('images/sample-user-photo.png') }}')">
											<i class="fas fa-trash"></i>
										<form id="force-delete-form-{{ $member->id }}" action="{{ route('anggota.force-delete', $member->id) }}" method="POST" class="d-none">
											@csrf
											@method('DELETE')
										</button>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="7" class="text-center font-weight-bold text-danger py-5">Tidak ada anggota terhapus!</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				{{-- /.body --}}

				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('anggota') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
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
	// Member delete confirmation.
	function confirmDelete(memberId, memberName, memberPhoto) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			imageUrl: memberPhoto,
			imageWidth: 200,
			imageHeight: 200,
			html: '<span class="text-danger">Setelah dihapus, Anda tidak dapat memulihkan anggota <b>"' + memberName + '"</b>!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus permanen!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit member's delete form.
				document.getElementById('force-delete-form-' + memberId).submit();
			}
		})
	};

	$(document).ready(function() {
		// Initialize DataTables to members table.
		$('#membersTable').DataTable({
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

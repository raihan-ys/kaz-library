@extends('layouts.app')
@section('title', 'Penyewaan Terhapus')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Penyewaan Terhapus</h1>
					</div>
					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('penyewaan') }}">
									<i class="fas fa-book"></i>
									Penyewaan
								</a>
							</li>
							<li class="breadcrumb-item active">
								Penyewaan Terhapus
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
					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="borrowingsTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Tanggal Peminjaman</th>
								<th scope="col">Tanggal Pengembalian</th>
								<th scope="col">Status</th>
								<th scope="col">Keterlambatan</th>
								<th scope="col">Denda Keterlambatan</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($borrowings as $brw)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ formatDate($brw->borrow_date, 'd-m-Y') }}</td>
								<td>{{ $brw->return_date ? formatDate($brw->return_date, 'd-m-Y') : '-' }}</td>
								<td>{{ $brw->status }}</td>
								<td>
									<?php
									// Check if return date or today is later than due date.
									$borrowDate = \Carbon\Carbon::parse($brw->borrow_date);
									$dueDate = $borrowDate->copy()->addDays(7);
									$returnDate = $brw->return_date ? \Carbon\Carbon::parse($brw->return_date) : \Carbon\Carbon::now();

									$lateFee = 0;
									$isLate = false;

									// Calculate late days.
									if ($returnDate->gt($dueDate)) {
										$lateDays = (int) abs($returnDate->diffInDays($dueDate));
										$lateFee = $lateDays * 1000;
										$isLate = true;

										echo '<span class="badge badge-danger">';
										echo "Terlambat {$lateDays} hari";
										echo '</span>';
									} else {
										echo '<span class="badge badge-success">';
										echo 'Tidak Terlambat';
										echo '</span>';
									}
									?>
								</td>
								<td>
									@if($isLate)
									{{ formatRp($lateFee, 2) }}
									@else
									-
									@endif
								</td>
								<td>
									<div class="btn-group">
										{{-- restore --}}
										<a href="{{ route('penyewaan.restore', $brw->id) }}" class="btn btn-success" title="Pulihkan" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $brw->id }}').submit();">
											<i class="fas fa-undo"></i>
										</a>
										<form method="POST" class="d-none" id="restore-form-{{ $brw->id }}" action="{{ route('penyewaan.restore', $brw->id) }}">
											@csrf
										</form>
										{{-- force delete --}}
										<button type="submit" class="btn btn-danger" data-brw-id="{{ $brw->id }}" title="Hapus Permanen" onclick="confirmDelete({{ $brw->id }})">
											<i class="fas fa-trash"></i>
										</button>
										<form id="force-delete-form-{{ $brw->id }}" action="{{ route('penyewaan.force-delete', $brw->id) }}" method="POST" class="d-none">
											@csrf
											@method('DELETE')
										</form>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="9" class="text-center font-weight-bold text-danger py-5">Tidak ada penyewaan terhapus!</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				{{-- /.body --}}


				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('penyewaan') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
				</div>
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.col --}}
	</div>
	{{-- /.row --}}
</div>
@endsection

@section('js')
{{-- Moment.js (required by daterangepicker) --}}
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
{{-- Daterangepicker JS --}}
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- Tempus Dominus Bootstrap 4 --}}
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
	// Borrowing delete confirmation.
	function confirmDelete(brwId) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			imageUrl: bookCover,
			imageWidth: 200,
			imageHeight: 300,
			html: '<span class="text-danger">Setelah dihapus, Anda tidak dapat memulihkan peminjaman buku ini!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus permanen!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit borrowing's delete form.
				document.getElementById('force-delete-form-' + brwId).submit();
			}
		});
	}

	$(document).ready( function() {
		// Initialize DataTables to borrowings table.
		$('#borrowingsTable').DataTable({
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

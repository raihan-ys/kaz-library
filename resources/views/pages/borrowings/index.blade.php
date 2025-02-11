@extends('layouts.app')
@section('title', 'Daftar Penyewaan')

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
						<h1>Daftar Penyewaan Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book"></i> Penyewaan</li>
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

					{{-- check if there are books and members --}}
					@if(count($books) > 0 && count($members) > 0)
					{{-- create borrowing button --}}
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBorrowingModal">
						<i class="fas fa-plus"></i> Tambah Penyewaan
					</button>

					{{-- create borrowing modal --}}
					<div class="modal fade" id="createBorrowingModal">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								{{-- header --}}
								<div class="modal-header">
									<h4 class="modal-title font-weight-bold">Form Tambah Penyewaan</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<form id="createBorrowingForm" action="{{ route('penyewaan.store') }}" method="post">
									{{-- body --}}
									<div class="modal-body">
										@csrf
						
										{{-- librarian id --}}
										<input type="hidden" name="librarian_id" value="{{ Auth::user()->id }}">

										{{-- member id --}}
										<div class="form-group">
											<label for="member_id">Anggota</label>
											<select name="member_id" id="member_id" class="form-control {{ $errors->has('member_id') ? 'bg-danger text-white' : '' }}" required>
												<option selected disabled hidden>- Pilih Anggota -</option>
												@foreach($members as $member)
												<option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->full_name }}</option>
												@endforeach
											</select>
											@if($errors->has('member_id'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('member_id') }}
											</span>
											@endif
										</div>
										
										{{-- book id --}}
										<div class="form-group">
											<label for="book_id">Buku</label>
											<select name="book_id" id="book_id" class="form-control {{ $errors->has('book_id') ? 'bg-danger text-white' : '' }}" required>
												<option selected disabled hidden>- Pilih Buku -</option>
												@foreach($books as $book)
												<option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }} data-rental-price="{{ $book->rental_price }}">{{ $book->title }}</option>
												@endforeach
											</select>
											@if($errors->has('book_id'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('book_id') }}
											</span>
											@endif
										</div>
									
										<div class="form-row">
											{{-- borrow date --}}
											<div class="col-md-6 mb-3">
												<label for="borrow_date">Tanggal</label>
												<div class="input-group date" id="borrow_date" data-target-input="nearest">
													<input type="text" data-target="#borrow_date" name="borrow_date" class="datetimepicker-input form-control {{ $errors->has('borrow_date') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Tanggal Peminjaman" value="{{ old('borrow_date') }}" required readonly>
													<div class="input-group-append" data-target="#borrow_date" data-toggle="datetimepicker">
														<div class="input-group-text"><i class="fa fa-calendar"></i></div>
													</div>
												</div>
												@if($errors->has('borrow_date'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('borrow_date') }}
												</span>
												@endif
											</div>

											{{-- rental_price--}}
											<div class="col-md-6 mb-3">
												<label for="rental_price">Biaya Sewa</label>
												<input type="number" name="rental_price" id="rental_price" class="bg-white form-control {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" value="{{ old('rental_price') }}" required readonly>
												@if($errors->has('rental_price'))
												{{-- error message --}}
												<span class="text-danger">
													{{ $errors->first('rental_price') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									{{-- /.body --}}

									{{-- footer --}}
									<div class="modal-footer justify-content-between btn-group">
										<button type="reset" id="resetButton" class="btn btn-outline-danger">Reset</button>
										<button type="submit" class="btn btn-outline-primary" id="createBook">Simpan</button>
									</div>
								</form>
							</div>
							{{-- /.modal-content --}}
						</div>
						{{-- /.modal-dialog --}}
					</div>
					{{-- /.create borrowing modal --}}
					@endif

					{{-- soft deleted borrowings button --}}
					<a href="{{ route('penyewaan.trashed') }}" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i> Penyewaan Terhapus
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
				{{-- /.header --}}

				{{-- body --}}
				<div class="card-body table-responsive">
					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="borrowingsTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Anggota</th>
								<th scope="col">Buku</th>
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
								<td class="font-weight-bold">{{ $brw->member->full_name }}</td>
								<td class="font-weight-bold">{{ $brw->book_title }}</td>
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
										{{-- show --}}
										<a href="{{ route('penyewaan.show', $brw->id) }}" class="btn btn-info" title="Detail">
											<i class="fas fa-eye"></i>
										</a>
										{{-- update --}}
										<a href="{{ route('penyewaan.edit', $brw->id) }}" class="btn btn-warning" title="Edit">
											<i class="fas fa-edit"></i>
										</a>
										{{-- delete --}}
										<button type="submit" class="btn btn-danger" data-brw-id="{{ $brw->id }}" title="Hapus" onclick="confirmDelete({{ $brw->id }}, '{{ $brw->book_title }}', '{{ $brw->book_cover ? asset('storage/'.$brw->book_cover) : asset('images/sample-book-cover.png') }}','{{ $brw->member->full_name }}')">
											<i class="fas fa-trash"></i>
										</button>
										<form id="delete-form-{{ $brw->id }}" action="{{ route('penyewaan.destroy', $brw->id) }}" method="post" style="display:none">
											@csrf
											@method('DELETE')
										</form>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="9" class="text-center font-weight-bold text-danger py-5">Tidak ada penyewaan buku!</td>
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
{{-- Moment.js (required by daterangepicker) --}}
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
{{-- Daterangepicker JS --}}
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- Tempus Dominus Bootstrap 4 --}}
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
	// Borrowing delete confirmation.
	function confirmDelete(brwId, bookTitle, bookCover, memberName) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			imageUrl: bookCover,
			imageWidth: 200,
			imageHeight: 300,
			html: 'Peminjaman buku <b>"' + bookTitle + '"</b> oleh <b>"' + memberName + '"</b> akan dihapus dari tabel ini!',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit borrowing's delete form.
				document.getElementById('delete-form-' + brwId).submit();
			}
		});
	}

	$(document).ready( function() {
		// Initialize date time picker for borrow date field.
		$('#borrow_date').datetimepicker({
			format: 'YYYY-MM-DD',
			maxDate: moment().add(0, 'days')
		});

		// Change member id field colors.
		$('#member_id').change(function(e) {
			$("#member_id").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change book id field colors.
		$('#book_id').change(function(e) {
			$("#book_id").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change borrow date field colors.
		$('#borrow_date').change(function(e) {
			$("#borrow_date").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change rental price colors.
		$('#rental_price').change(function(e) {
			$("#rental_price").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Update rental price on book id change.
		$('#book_id').on('change', function() {
			const rentalPrice = $('#rental_price');
			const selectedOption = $(this).find('option:selected');
			rentalPrice.val(selectedOption.data('rental-price'));
		});

		// Reset all input fields.
		$('#resetButton').click(function() {
			// Member ID.
			$("#member_id").removeClass('bg-danger text-white');
			$("#member_id").next('.text-danger').addClass('d-none');

			// Book ID.
			$("#book_id").removeClass('bg-danger text-white');
			$("#book_id").next('.text-danger').addClass('d-none');

			// Borrow date.
			$("#borrow_date").val('');
			$("#borrow_date").removeClass('bg-danger text-white');
			$("#borrow_date").next('.text-danger').addClass('d-none');

			// Rental price.
			$("#rental_price").val('');
			$("#rental_price").removeClass('bg-danger text-white');
			$("#rental_price").next('.text-danger').addClass('d-none');
		});

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

@extends('layouts.app')
@section('title', 'Edit Penyewaan - Kaz-Library')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">

					{{-- page title --}}
					<div class="col-sm-6">
						<h1>Edit Penyewaan Buku</h1>
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
								Edit Penyewaan
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
			<h5 class="font-weight-bold">Form Edit Penyewaan</h5>
		</div>

		<form action="{{ route('penyewaan.update', $borrowing->id) }}" onsubmit="checkReturnDate()" method="post">
			{{-- body --}}
			<div class="card-body">

				{{-- error messages --}}
				@if($errors->any())
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
				@endif
				{{-- /.error messages --}}

				@csrf
				@method('PUT')
		
				{{-- borrowing id --}}
				<input type="hidden" name="id" value="{{ $borrowing->id }}">

				{{-- librarian id --}}
				<input type="hidden" name="librarian_id" value="{{ $borrowing->librarian_id }}">

				{{-- member id --}}
				<div class="form-group">
					<label for="member_id">Anggota</label>
					<select name="member_id" id="member_id" class="form-control {{ $errors->has('member_id') ? 'bg-danger text-white' : '' }}" required>
						<option selected diabled hidden>- Pilih Anggota -</option>
						@foreach($members as $member)
						<option value="{{ $member->id }}" {{ $member->id === $borrowing->member_id ? 'selected' : '' }}>{{ $member->full_name }}</option>
						@endforeach
					</select>
					{{-- error message --}}
					@if($errors->has('member_id'))
					<span class="text-danger">
						{{ $errors->first('member_id') }}
					</span>
					@endif
				</div>
				
				{{-- book id --}}
				<div class="form-group">
					<label for="book_id">Buku</label>
					<select name="book_id" id="book_id" class="form-control {{ $errors->has('book_id') ? 'bg-danger text-white' : '' }}">
						<option selected disabled hidden>- Pilih Buku -</option>
						@foreach($books as $book)
						<option value="{{ $book->id }}" {{ $book->id === $borrowing->book_id ? 'selected' : '' }} data-rental-price="{{ $book->rental_price }}">{{ $book->title }}</option>
						@endforeach
					</select>
					{{-- error message --}}
					@if($errors->has('book_id'))
					<span class="text-danger">
						{{ $errors->first('book_id') }}
					</span>
					@endif
				</div>
				
				<div class="form-row">
					{{-- borrow date --}}
					<div class="col-md-6 mb-3">
						<label for="borrow_date">Tanggal Peminjaman</label>
						<input type="date" name="borrow_date" id="borrow_date" class="form-control {{ $errors->has('borrow_date') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Tanggal Peminjaman" maxlength="20" value="{{ old('borrow_date',\Carbon\Carbon::parse($borrowing->borrow_date)->format('Y-m-d')) }}" required>
						{{-- error message --}}
						@if($errors->has('borrow_date'))
						<span class="text-danger">
							{{ $errors->first('borrow_date') }}
						</span>
						@endif
					</div>
					{{-- rental price--}}
					<div class="col-md-6 mb-3">
						<label for="rental_price">Biaya Sewa</label>
						<input type="number" name="rental_price" id="rental_price" class="form-control bg-white {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" min="0" max="99999" value="{{ old('rental_price', $borrowing->rental_price) }}" required readonly>
						{{-- error message --}}
						@if($errors->has('rental_price'))
						<span class="text-danger">
							{{ $errors->first('rental_price') }}
						</span>
						@endif
					</div>
				</div>

				<div class="form-row">
					{{-- return date --}}
					<div class="col-md-6 mb-3">
						<label for="return_date">Tanggal Pengembalian</label>
						<input type="date" name="return_date" id="return_date" class="form-control {{ $errors->has('return_date') ? 'bg-danger text-white' : '' }}" maxlength="20" value="{{ old('return_date', $borrowing->status === 'dikembalikan' ?	\Carbon\Carbon::parse($borrowing->return_date)->format('Y-m-d') : '') }}" required>
						{{-- error message --}}
						@if($errors->has('return_date'))
						<span class="text-danger">
							{{ $errors->first('return_date') }}
						</span>
						@endif
					</div>
					{{-- status --}}
					<div class="col-md-6 mb-3">
						<label for="status">Status Peminjaman</label>
						<select name="status" id="status" class="form-control {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" required>
							<option value="dipinjam" {{ $borrowing->status === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
							<option value="dikembalikan" {{ $borrowing->status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
						</select>
						{{-- error message --}}
						@if($errors->has('status'))
						<span class="text-danger">
							{{ $errors->first('status') }}
						</span>
						@endif
					</div>
				</div>
			</div>
			
			{{-- footer --}}
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i>
					Simpan
				</button>
				<a href="{{ route('penyewaan') }}" class="btn btn-secondary">
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
		// Update the return date value.
    function updateReturnDateField() {
			var status = $('#status').val();
			if (status == 'dipinjam') {
				$('#return_date').val('').prop('disabled', true);
			} else if (status == 'dikembalikan') {
				$('#return_date').prop('disabled', false);
			} else {
				$('#return_date').val('').prop('disabled', true);
			}
    }

    // Check when the status changes.
    $('#status').change(function() {
			updateReturnDateField();
    });

		// Change rental price value based on book id's value.
		$("#book_id").on('change', function() {
			const rentalPrice = $("#rental_price");
			const selectedOption = this.options[this.selectedIndex];
			rentalPrice.val(selectedOption.getAttribute('data-rental-price'));
		});

		// Initial check when the page loads.
    updateReturnDateField();
	});
</script>
@endsection

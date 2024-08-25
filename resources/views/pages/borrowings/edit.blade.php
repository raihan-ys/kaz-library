@extends('layouts.app')

@section('page-header')
<div class="row">
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
								<a href="{{ route('buku') }}">
									<i class="fas fa-book"></i>
									Penyewaan Buku
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

		<form action="{{ route('penyewaan.update', $borrowing->id) }}" method="post">
			{{-- body --}}
			<div class="card-body">

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

				@csrf
				@method('PUT')
		
				{{-- id --}}
				<input type="hidden" name="id" value="{{ $borrowing->id }}">

				{{-- member id --}}
				<div class="form-group">
					<label for="member_id">Anggota</label>
					<select name="member_id" id="member_id" class="form-control {{ $errors->has('member_id') ? 'bg-danger text-white' : '' }}" required>
						<option selected diabled hidden>- Pilih Anggota -</option>
						@foreach($members as $member)
						<option value="{{ $member->id }}" {{ $member->id === $borrowing->member_id ? 'selected' : '' }}>{{ $member->full_name }}</option>
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
					<select name="book_id" id="book_id" class="form-control {{ $errors->has('book_id') ? 'bg-danger text-white' : '' }}">
						<option selected disabled hidden>- Pilih Buku -</option>
						@foreach($books as $book)
						<option value="{{ $book->id }}" {{ $book->id === $borrowing->book_id ? 'selected' : '' }}>{{ $book->title }}</option>
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
						<input type="date" name="borrow_date" id="borrow_date" class="form-control {{ $errors->has('borrow_date') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Tanggal Peminjaman" maxlength="20" value="{{ null !== old('borrow_date') ? old('borrow_date') : $borrowing->borrow_date }}" required>
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
						<input type="number" name="rental_price" id="rental_price" class="form-control {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Biaya Sewa" min="0" max="99999" value="{{ null !== old('rental_price') ? old('rental_price') : $borrowing->rental_price }}" required>
						@if($errors->has('rental_price'))
						{{-- error message --}}
						<span class="text-danger">
							{{ $errors->first('rental_price') }}
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
				<a href="{{ route('buku') }}" class="btn btn-secondary">
					<i class="fas fa-arrow-left"></i>
					Kembali
				</a>
			</div>
		</form>
	</div>
</div>
@endsection

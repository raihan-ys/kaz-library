@extends('layouts.app')
@section('title', 'Detail Penyewaan - Kaz-Library')
@section('page-header')
<div class="row m-0">
	<div class="col-12 col-lg-8 offset-lg-2">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">

					{{-- page title --}}
					<div class="col-sm-6">
						<h1>Detail Penyewaan Buku</h1>
					</div>

					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('penyewaan') }}">
									<i class="fas fa-book mr-1"></i>
 									Penyewaan
								</a>
							</li>
							<li class="breadcrumb-item active">Detail</li>
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
		<div class="col-12 col-lg-8 offset-lg-2">
			<div class="card" style="border-top: #181C32 solid 5px">
				{{-- header --}}
				<div class="card-header">
					<h5 class="card-title font-weight-bold">Detail Penyewaan Buku</h5>
				</div>
				{{-- body --}}
				<div class="card-body">

					{{-- success message --}}
					@if(session('success'))
					<div class="alert alert-success">
						<span class="font-weight-bold" style="float: right; cursor: pointer;" id="closeAlert">&times;</span>
						<i class="fas fa-check"></i>
						{{ session('success') }}
					</div>
					@endif

					{{-- late return alert --}}
					@if($isLate)
					<div class="alert text-white" style="background-color: red">
						<h5 class="font-weight-bold">
							<i class="icon fas fa-exclamation-triangle"></i>
							Keterlambatan!
						</h5><hr class="bg-white">
						@if($borrowing->return_date)
						Buku ini terlambat dikembalikan selama {{ $lateDays }} hari. Denda yang dikenakan: Rp. {{ number_format($lateFee, 0, ',', '.') }}.
						@else
						Buku ini sudah terlambat selama {{ $lateDays }} hari. Denda yang dikenakan saat ini: Rp. {{ number_format($lateFee, 0, ',', '.') }}.
						@endif
					</div>
					@endif

					<div class="row">

						{{-- book cover image --}}
						<div class="m-auto">
							<img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : asset('images/sample-book-cover.png') }}" alt="Book's Image Preview" class="img-fluid img-thumbnail" style="max-width: 300px">
						</div>

						<div class="col-md-8">
							{{-- member --}}
							<div class="form-group">
								<label for="member_id">Peminjam</label>
								<p id="member_id">{{ $borrowing->member->full_name }}</p>
							</div>

							{{-- book --}}
							<div class="form-group">
								<label for="book_id">Judul Buku</label>
								<p>{{ $borrowing->book->title }}</p>
							</div>

							{{-- borrow date --}}
							<div class="form-group">
								<label for="borrow_date">Tanggal Peminjaman</label>
								<p>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d-m-Y') }}</p>
							</div>

							{{-- return date --}}
							<div class="form-group">
								<label for="return_date">Tanggal Pengembalian</label>
								<p>{{ $borrowing->return_date ?\Carbon\Carbon::parse($borrowing->return_date)->format('d-m-Y') : '-' }}</p>
							</div>

							{{-- status --}}
							<div class="form-group">
								<label for="status">Status</label>
								<p>{{ $borrowing->status }}</p>
							</div>
						</div>
					</div>
				</div>
				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('penyewaan') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

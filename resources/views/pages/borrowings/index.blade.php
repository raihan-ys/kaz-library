@extends('layouts.app')

@section('page-header')
<div class="row">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Penyewaan Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Penyewaan</li>
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
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBorrowingModal">
						<i class="fas fa-plus mr-1"></i>Tambah Penyewaan
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

								<form id="createBookForm" action="{{ route('penyewaan.store') }}" method="post">
									{{-- body --}}
									<div class="modal-body">
										@csrf
						
										{{-- librarian id --}}
										<input type="hidden" name="librarian_id" value="2">

										{{-- member id --}}
										<div class="form-group">
											<label for="member_id">Anggota</label>
											<select name="member_id" id="member_id" class="form-control {{ $errors->has('member_id') ? 'bg-danger text-white' : '' }}" required>
												<option selected diabled hidden>- Pilih Anggota -</option>
												@foreach($members as $member)
												<option value="{{ $member->id }}" {{ $member->id === old('member_id') ? 'selected' : '' }}>{{ $member->full_name }}</option>
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
												<option value="{{ $book->id }}" {{ $book->id === old('book_id') ? 'selected' : '' }}>{{ $book->title }}</option>
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
												<input type="date" name="borrow_date" id="borrow_date" class="form-control {{ $errors->has('borrow_date') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Tanggal Peminjaman" maxlength="20" value="{{ old('borrow_date') }}" required>
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
												<input type="number" name="rental_price" id="rental_price" class="form-control {{ $errors->has('rental_price') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Biaya Sewa" min="0" max="99999" value="{{ old('rental_price') }}" required>
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
										<button type="button" class="btn btn-outline-secondary" id="closeModal" data-dismiss="modal">Batal</button>
										<button type="reset" class="btn btn-outline-info">Reset</button>
										<button type="submit" class="btn btn-outline-primary" id="createBook">Simpan</button>
									</div>
								</form>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					{{-- /.create borrowing modal --}}

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
					<table class="table table-bordered table-hover">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Anggota</th>
								<th scope="col">Buku</th>
								<th scope="col">Tanggal Peminjaman</th>
								<th scope="col">Tanggal Pengembalian</th>
								<th scope="col">Biaya Sewa</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($borrowings as $brw)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $brw->member->full_name }}</td>
								<td class="font-weight-bold">{{ $brw->book->title }}</td>
								<td>{{ $brw->borrow_date }}</td>
								<td>{{ $brw->return_date ?? '-' }}</td>
								<td>{{ $brw->rental_price }}</td>
								<td>{{ $brw->status }}</td>
								<td>
									<div class="btn-group">
										{{-- show --}}
										<a href="{{ route('penyewaan.show', $brw->id) }}" class="btn btn-info" title="Detail Peminjaman">
											<i class="fas fa-eye"></i>
										</a>
										{{-- update --}}
										<a href="{{ route('penyewaan.edit', $brw->id) }}" class="btn btn-warning" title="Edit">
											<i class="fas fa-edit"></i>
										</a>
										{{-- delete --}}
										<form id="deleteForm" action="{{ route('penyewaan.destroy', $brw->id) }}" method="post" style="display:none">
											@csrf
											@method('DELETE')
										</form>
										<button type="submit" class="btn btn-danger" title="Hapus" id="deleteButton">
											<i class="fas fa-trash"></i>
										</button>
									</div>
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
<script type="text/javascript">
	const bookId = document.getElementById('book_id');
	const rentalPrice = document.getElementById('rental_price');
	const selectedOption = bookSelect.options[bookSelect.selectedIndex];
	const rentalPrice = selectedOption.getAttribute('data-rental-price');
	rentalPrice.value = rentalPrice;
</script>
@endsection

@extends('layouts.app')
@section('title', 'Daftar Anggota - Kaz-Library')
@section('page-header')
<div class="row">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Anggota</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-users mr-1"></i> Anggota</li>
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
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBookModal">
						<i class="fas fa-plus mr-1"></i>Tambah Anggota
					</button>

					{{-- create user modal --}}
					<div class="modal fade" id="createBookModal">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								{{-- header --}}
								<div class="modal-header">
									<h4 class="modal-title font-weight-bold">Form Tambah Anggota</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<form id="createUserForm" action="{{ route('anggota.store') }}" method="post">
									{{-- body --}}
									<div class="modal-body">
										@csrf
						
										{{-- full name --}}
										<div class="form-group">
											<label for="full_name">Nama</label>
											<input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Nama Lengkap" maxlength="100" value="{{ old('full_name') }}" required>
											@if($errors->has('full_name'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('full_name') }}
											</span>
											@endif
										</div>
										
										{{-- address --}}
										<div class="form-group">
											<label for="address">Alamat</label>
											<textarea name="address" id="address" class="form-control {{ $errors->has('address') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Alamat Anggota" maxlength="255">{{ old('address') }}</textarea>
											@if($errors->has('address'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('address') }}
											</span>
											@endif
										</div>
										
										{{-- phone --}}
										<div class="form-group">
											<label for="phone">Nomor Telepon</label>
											<input type="tel" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Nomor Telepon Anggota" maxlength="15" value="{{ old('phone') }}" required>
											@if($errors->has('phone'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('phone') }}
											</span>
											@endif
										</div>

										{{-- email --}}
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Email Anggota" value="{{ old('email') }}" maxlength="255" required>
											@if($errors->has('email'))
											{{-- error message --}}
											<span class="text-danger">
												{{ $errors->first('email') }}
											</span>
											@endif
										</div>
									</div>
									{{-- /.body --}}

									{{-- footer --}}
									<div class="modal-footer justify-content-between btn-group">
										<button type="reset" class="btn btn-outline-danger">Reset</button>
										<button type="submit" class="btn btn-outline-primary" id="createBook">Simpan</button>
									</div>
								</form>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					{{-- /.create book modal --}}

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
				</div>
				{{-- /.header --}}

				{{-- body --}}
				<div class="card-body table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
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
								<td>{{ $member->address }}</td>
								<td>{{ $member->phone }}</td>
								<td>{{ $member->email }}</td>
								<td>
									<div class="btn-group">
										{{-- show --}}
										<a href="{{ route('anggota.show', $member->id) }}" class="btn btn-info" title="Detail">
											<i class="fas fa-eye"></i>
										</a>
										{{-- update --}}
										<a href="{{ route('anggota.edit', $member->id) }}" class="btn btn-warning" title="Edit">
											<i class="fas fa-edit"></i>
										</a>
										{{-- delete --}}
										<button type="button" class="delete-btn btn btn-danger" data-member-id="{{ $member->id }}" title="Hapus">
											<i class="fas fa-trash"></i>
										</button>
										<form id="delete-form-{{ $member->id }}" action="{{ route('anggota.destroy', $member->id) }}" method="post" style="display:none">
											@csrf
											@method('DELETE')
										</form>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="6" class="text-center font-weight-bold text-danger py-5">Tidak ada anggota yang terdaftar!</td>
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
	$(document).ready(function(){
		$('.delete-btn').on('click', function() {
			var memberId = $(this).data('member-id');
			if (confirm('Apakah Anda yakin ingin menghapus anggota ini?')) {
				$('#delete-form-' + memberId).submit();
			}
		});
	});
</script>
@endsection

@extends('layouts.app')
@section('title', 'Edit Anggota - Kaz-Library')
@section('page-header')
<div class="row">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">

					{{-- page full_name --}}
					<div class="col-sm-6">
						<h1>Edit Anggota</h1>
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
								Edit
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
			<h5 class="font-weight-bold">Form Edit Anggota</h5>
		</div>

		<form action="{{ route('anggota.update', $member->id) }}" method="post">

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
		
				{{-- id --}}
				<input type="hidden" name="id" value="{{ $member->id }}">

				{{-- full name --}}
				<div class="form-group">
					<label for="full_name">Nama</label>
					<input type="text" class="form-control {{ $errors->has('full_name') ? 'bg-danger text-white' : '' }}" id="full_name" name="full_name" value="{{ null !== old('full_name') ? old('full_name') : $member->full_name }}" placeholder="Masukkan Nama Lengkap Anggota" maxlength="100" required>
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
					<textarea name="address" id="address" class="form-control {{ $errors->has('address') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Alamat Anggota" maxlength="255">{{ null !== old('address') ? old('address') : $member->address }}</textarea>
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
					<input type="tel" class="form-control {{ $errors->has('phone') ? 'bg-danger text-white' : '' }}" id="phone" name="phone" value="{{ null !== old('phone') ? old('phone') : $member->phone }}" placeholder="Masukkan Nomor Telepon Anggota" maxlength="15" required>
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
					<input type="email" class="form-control {{ $errors->has('email') ? 'bg-danger text-white' : '' }}" id="email" name="email" value="{{ null !== old('email') ? old('email') : $member->email }}" placeholder="Masukkan Email Anggota" maxlength="255" required>
					@if($errors->has('email'))
					{{-- error message --}}
					<span class="text-danger">
						{{ $errors->first('email') }}
					</span>
					@endif
				</div>
			</div>
			
			{{-- footer --}}
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i>
					Simpan
				</button>
				<a href="{{ route('anggota') }}" class="btn btn-secondary">
					<i class="fas fa-arrow-left"></i>
					Kembali
				</a>
			</div>
		</form>
	</div>
</div>
@endsection

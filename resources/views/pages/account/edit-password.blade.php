@extends('layouts.app')
@section('title', 'Akun - Kaz-Library')

@section('page-header')
<div class="row">
	<div class="col-12 col-lg-8 offset-lg-2">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">

					{{-- page title --}}
					<div class="col-sm-6">
						<h1>Pengaturan Akun</h1>
					</div>

					{{-- breadcrumb --}}
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<a href="{{ route('akun', Auth::user()->id) }}">
									<i class="fas fa-users-cog"></i>
									Akun
								</a>
							</li>
							<li class="breadcrumb-item active">
								Edit Password
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
		<div class="col-12 col-lg-8 offset-lg-2">

			<div class="card">
				{{-- header --}}
				<div class="card-header" style="border-top: #181C32 solid 5px">
					<h5 class="font-weight-bold">Form Edit Password</h5>
				</div>

				<form action="{{ route('akun.update-password', Auth::user()->id) }}" method="post">

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

						{{-- current password --}}
						<div class="form-group">
							<label for="current_password">Password Saat Ini</label>
							<input type="password" class="form-control {{ $errors->has('curren_password') ? 'bg-danger text-white' : '' }}" id="current_password" name="current_password" value="{{ old('current_password') }}" placeholder="Masukkan password saat ini" maxlength="255" required>
							@if($errors->has('current_password'))
							{{-- error message --}}
							<span class="text-danger">
								{{ $errors->first('current_password') }}
							</span>
							@endif
						</div>
							
						{{-- new password --}}
						<div class="form-group">
							<label for="new_password">Password Baru</label>
							<input type="password" class="form-control {{ $errors->has('new_password') ? 'bg-danger text-white' : '' }}" id="new_password" name="new_password" value="{{ old('new_password') }}" placeholder="Masukkan password baru" maxlength="255" required>
							<small class="form-text text-muted">Password terdiri dari minimal 8 karakter dan terdiri dari huruf kecil, huruf kapital dan angka.</small>
							@if($errors->has('new_password'))
							{{-- error message --}}
							<span class="text-danger">
								{{ $errors->first('new_password') }}
							</span>
							@endif
						</div>

						{{-- new password confirmation --}}
						<div class="form-group">
							<label for="new_password_confirmation">Konfirmasi Password Baru</label>
							<input type="password" class="form-control {{ $errors->has('new_password_confirmation') ? 'bg-danger text-white' : '' }}" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" placeholder="Konfirmasi password baru" maxlength="255" required>
							@if($errors->has('new_password_confirmation'))
							{{-- error message --}}
							<span class="text-danger">
								{{ $errors->first('new_password_confirmation') }}
							</span>
							@endif
						</div>
					</div>
					
					{{-- footer --}}
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">
							<i class="fas fa-save"></i>
							Ubah
						</button>
						<a href="{{ route('akun', Auth::user()->id) }}" class="btn btn-secondary">
							<i class="fas fa-arrow-left"></i>
							Kembali
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

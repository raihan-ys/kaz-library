@extends('layouts.app')
@section('title', 'Akun - Kaz-Library')

@section('page-header')
<div class="row m-0">
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
							<li class="breadcrumb-item active">
								<i class="fas fa-users-cog"></i>
								Akun
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
			<div class="card" style="border-top: 5px solid #181C32">

				{{-- header --}}
				<div class="card-header">
					<div class="d-flex flex-row" style="gap: 10px;">
						<a href="{{ route('akun.edit', $user->id) }}" role="button" class="btn btn-primary">
							<i class="fas fa-edit"></i>
							Edit Profil
						</a>
						<a href="{{ route('akun.edit-password', $user->id) }}" role="button" class="btn btn-warning">
							<i class="fas fa-lock"></i> Ubah Password
						</a>
					</div>
				</div>

				<div class="card-body">

					{{-- success message --}}
					@if(session('success'))
					<div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
						{{-- toast header --}}
						<div class="toast-header" style="font-size: 20px;">
							<i class="fas fa-check mr-1"></i>
							<strong class="mr-auto">Sukses!</strong>
							<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						{{-- toast body --}}
						<div class="toast-body" style="font-size: 15px">
							{{ session('success') }}
						</div>
					</div>
					<script>
						$(document).ready(function(){
							$('.toast').toast({ delay: 5000 });
							$('.toast').toast('show');
						});
					</script>
					@endif

					<div class="row">
						{{-- profile photo --}}
						<div class="m-auto">
							<img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('images/sample-user-photo.jpeg') }}" alt="User's Profile Photo Preview" class="rounded img-fluid" style="width: 200px; height: 200px">
						</div>

						<div class="col-md-8">
							{{-- name --}}
							<div class="form-group">
								<label for="name">Nama</label>
								<p id="name">{{ $user->name }}</p>
							</div>

							{{-- email --}}
							<div class="form-group">
								<label for="email">Email</label>
								<p id="email">{{ $user->email }}</p>
							</div>

							{{-- role --}}
							<div class="form-group">
								<label for="role">Peran</label>
								<p id="role">{{ $user->role }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
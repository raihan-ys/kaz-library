@extends('layouts.app')
@section('title', 'Detail Anggota - Kaz-Library')
@section('page-header')
<div class="row m-0">
	<div class="col-12 col-lg-8 offset-lg-2">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">

					{{-- page title --}}
					<div class="col-sm-6">
						<h1>Detail Anggota</h1>
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
								Detail
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
			<div class="card" style="border-top: #181C32 solid 5px">
				<div class="card-header">
					<h5 class="font-weight-bold">Detail Anggota</h5>
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

					{{-- member data --}}
					<div class="row">
						{{-- profile photo --}}
						<div class="m-auto">
							<img src="{{ $member->profile_photo ? asset('storage/'.$member->profile_photo) : asset('images/sample-user-photo.jpeg') }}" alt="Member's Profile Photo Preview" class="img-fluid img-thumbnail" style="width: 200px; height: 200px">
						</div>
				
						<div class="col-md-8">
							{{-- full name --}}
							<div class="form-group">
								<label for="full_name">Nama</label>
								<p id="full_name">{{ $member->full_name }}</p>
							</div>

							{{-- type --}}
							<div class="form-group">
								<label for="type_name">Tipe</label>
								<p id="type_name">{{ $member->type_name }}</p>
							</div>

							{{-- address --}}
							<div class="form-group">
								<label for="address">Alamat</label>
								<p id="address">{{ $member->address }}</p>
							</div>

							{{-- phone --}}
							<div class="form-group">
								<label for="phone">Nomor Telepon</label>
								<p id="phone">{{ $member->phone }}</p>
							</div>

							{{-- email --}}
							<div class="form-group">
								<label for="email">Email</label>
								<p id="email">{{ $member->email }}</p>
							</div>
						</div>
					</div>
					{{-- /.member data --}}
				</div>
				{{-- /.body --}}

				{{-- footer --}}
				<div class="card-footer">
					<a href="{{ route('anggota') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

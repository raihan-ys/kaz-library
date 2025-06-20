@extends('layouts.app')
@section('title', 'Edit Anggota')
@section('page-header')
<div class="row m-0">
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

		<form id="editMemberForm" action="{{ route('anggota.update', $id) }}" method="post" enctype="multipart/form-data">

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
				<input type="hidden" name="id" value="{{ $id }}">

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

				{{-- type id --}}
				<div class="form-group">
					<label for="type_id">Tipe</label>
					<select name="type_id" id="type_id" class="form-control {{ $errors->has('type_id') ? 'bg-danger text-white' : '' }}" required>
						@foreach($member_types as $type)
						<option value="{{ $type->id }}" {{ $type->id === $member->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
						@endforeach
					</select>
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
					<input type="tel" class="form-control {{ $errors->has('phone') ? 'bg-danger text-white' : '' }}" id="phone" name="phone" value="{{ null !== old('phone') ? old('phone') : $member->phone }}" placeholder="Masukkan Nomor Telepon Anggota" maxlength="20" required>
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

				<!-- profile photo -->
				<div class="col-12">
											
					{{-- file input --}}
					<div class="form-group">
						<label for="profile_photo">Foto Profil</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="profile_photo" name="profile_photo" accept=".png" value="{{ old('profile_photo', $member->profile_photo) }}">
								<label class="custom-file-label {{ $errors->has('profile_photo') ? 'bg-danger text-white' : '' }}" for="profile_photo">Pilih gambar PNG</label>
							</div>
							<div class="input-group-append">
								<span class="input-group-text" id="uploadButton">Unggah</span>
							</div>
						</div>
						{{-- cancel upload --}}
						<button type="button" class="btn btn-danger mt-2 {{ $member->profile_photo ? '' : 'd-none' }}" id="cancelUpload">
							<i class="fas fa-trash"></i>
							Batalkan Pilihan
						</button>
						{{-- error message --}}
						@if ($errors->has('profile_photo'))
						<div class="text-danger">
							{{ $errors->first('profile_photo') }}
						</div>
						@endif
					</div>
					{{-- /.file input --}}

					{{-- image preview --}}
					<div class="row" id="previewContainer">
						<div class="col-3" id="imageContainer">
							<label for="photoPreview">Pratinjau Foto</label><br>
							<img id="photoPreview" src="{{ $member->profile_photo ? asset('storage/'.$member->profile_photo) : asset('images/sample-user-photo.jpeg') }}" alt="Member's Profile Photo Preview" class="img-fluid" style="width: 200px; height: 200px;"/>
						</div>

						{{-- Metadata from previous file --}}
						@if(session('file_metadata'))
						<div class="alert alert-danger">
							<strong>File Metadata:</strong>
							<ul>
								<li>Nama File: {{ session('file_metadata.name') }}</li>
								<li>Ukuran File: {{ session('file_metadata.size') }} bytes</li>
								<li>Jenis File: {{ session('file_metadata.type') }}</li>
							</ul>
						</div>
						@endif

						{{-- Current file metadata --}}
						<div class="col-9">
							<ul id="photoMetadata" class="list-unstyled mt-4">
								<li><span id="fileName"></span></li>
								<li><span id="fileSize"></span></li>
								<li><span id="fileType"></span></li>
							</ul>
						</div>
						<div class="text-danger d-none" id="fileError">
							File terlalu besar, maksimal ukuran 1 MB.
						</div>
						<div class="text-danger d-none" id="fileError2">
							File melebihi ukuran 2 MB, tidak dapat diunggah.
						</div>
					</div>
					{{-- /.image preview --}}
				</div>
				{{-- /.profile photo --}}
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

@section('js')
<script>
	$(document).ready(function() {
		// Change full name field colors.
		$('#full_name').change(function(e) {
			$("#full_name").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change type id field colors.
		$('#type_id').change(function(e) {
			$("#type_id").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change address field colors.
		$('#address').change(function(e) {
			$("#address").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change phone field colors.
		$('#phone').change(function(e) {
			$("#phone").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change email field colors.
		$('#email').change(function(e) {
			$("#email").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// File input change event.
		let canSubmit = true;
		$('#profile_photo').change(function(e) {
			// Change field colors.
			$("#profile_photo").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');

			// Get uploaded file.
			const file = e.target.files[0];
			if(file) {
				// Maximum file size in bytes (1 MB).
				const maxSizeBytes = 1048576;

				// Read the file.
				const reader = new FileReader();
				reader.onload = function(e) {
					// Set image preview.
					$("#photoPreview").attr('src', e.target.result);

					// Show the preview container.
					$("#previewContainer").removeClass('d-none');
					$("#cancelUpload").removeClass('d-none');
				}

				// Read the file as a data URL.
				reader.readAsDataURL(file);

				// Update the label with the file name.
				$(this).next('.custom-file-label').html(file.name);
							
				// Update metadata information.
				$('#fileName').text(file.name);

				// Check if file size exceeds the limit.
				if (file.size > maxSizeBytes) {
					// Display size in MB if file is too large.
					const fileSizeMB = (file.size / maxSizeBytes).toFixed(2);
					$('#fileSize').text(fileSizeMB + ' MB');

					// Change the file input field color.
					$('.custom-file-label').removeClass('bg-danger text-white');

					// Display image preview.
					$('#imageContainer').removeClass('d-none');
					$('#photoMetadata').addClass('mt-4');

					// Show error message.
					$("#fileError").removeClass('d-none');
					$('#fileError2').addClass('d-none');

					canSubmit = true;

					// If file is larger than 2 MB.
					if (file.size > 2048576) {
						// Change the file input field color.
						$('.custom-file-label').addClass('bg-danger text-white');

						// Hide image preview.
						$('#imageContainer').addClass('d-none');
						$('#photoMetadata').removeClass('mt-4');

						// Show error message.
						$('#fileError').addClass('d-none');
						$('#fileError2').removeClass('d-none');

						canSubmit = false;
					}
				} else {
					// Reset the file input field color.
					$('.custom-file-label').removeClass('bg-danger text-white');

					// Display size in KB if it's within the limit.
					$('#fileSize').text((file.size / 1024).toFixed(2) + ' KB');

					// Hide error message.
					$('#fileError').addClass('d-none');
					$('#fileError2').addClass('d-none');

					// Display preview.
					$('#imageContainer').removeClass('d-none');

					$('#photoMetadata').addClass('mt-4');

					canSubmit = true;
				}
				// Display file type.
				$('#fileType').text(file.type);

				// Prevent form submission based on the flag.
				$('#editMemberForm').submit(function(e) {
					if (!canSubmit) {
						e.preventDefault();
						return alert('Foto profil belum diunggah dengan benar!');
					}
				});
			} else {	
				// Reset file input label.
				$(this).next('.custom-file-label').html('Pilih gambar');

				// Clear metadata information.
				$('#fileName, #fileSize, #fileType').text('');
			}
		});

		// Reset file input.
		$('#cancelUpload').click(function() {

			$('#profile_photo').val('');

			// Reset file input label.
			$('.custom-file-label').removeClass('bg-danger text-white');
			$('.custom-file-label').html('Pilih gambar PNG');

			// Reset preview image.
			$('#previewContainer').addClass('d-none');

			// Hide any error messages.
			$('#fileError').addClass('d-none');
			$('#fileError2').addClass('d-none');

			// Clear metadata information
			$('#fileName').text('');
			$('#fileSize').text('');
			$('#fileType').text('');

			// Hide the cancel button.
			$('#cancelUpload').addClass('d-none');
		});
	});
</script>
@endsection

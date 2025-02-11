@extends('layouts.app')
@section('title', 'Aplikasi')

@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Pengaturan Aplikasi</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item active"><i class="fas fa-cog"></i> Aplikasi</li>
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
  <div class="card" style="border-top: 5px solid #181C32">
		<form id="appSettingForm" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
			
			<div class="card-body">

				@csrf

				{{-- app name --}}
				<div class="form-group">
					<label for="app_name">Nama Aplikasi</label>
					<input type="text" name="app_name" id="app_name" class="form-control" value="{{ config('app.name') }}">
				</div>

				{{-- app logo --}}
				<div class="form-group">	
					<label for="app_logo">Logo Aplikasi</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="app_logo" name="app_logo" accept=".png">
							<label class="custom-file-label {{ $errors->has('app_logo') ? 'bg-danger text-white' : '' }}" for="app_logo">Pilih gambar PNG</label>
						</div>
							<div class="input-group-append">
								<span class="input-group-text" id="uploadButton">Unggah</span>
							</div>
						</div>
						{{-- cancel upload --}}
						<button type="button" class="btn btn-danger mt-2" id="cancelUpload">
								<i class="fas fa-trash"></i>
								Batalkan Pilihan
						</button>
						{{-- error message --}}
						@if ($errors->has('app_logo'))
						<div class="text-danger">
								{{ $errors->first('app_logo') }}
						</div>
						@endif
					</div>
					{{-- /.file input --}}

					{{-- image preview --}}
					<div class="row" id="previewContainer">
						<div class="col-3" id="imageContainer">
							<label for="logoPreview">Pratinjau Logo</label><br>
							<img id="logoPreview" src="{{ asset('images/logo.png') }}" alt="Logo {{ config('app.name') }}" style="width: 200px; height: 200px;"/>
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
							<ul id="logoMetadata" class="list-unstyled mt-4">
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
				{{-- /.app logo --}}

				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</div>
			{{-- /.body --}}
		</form>
	</div>
	{{-- /.card --}}
</div>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		// Change app name field colors.
		$('#app_name').change(function(e) {
			$("#app_name").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// Change app logo field colors.
		$('#app_logo').change(function(e) {
			$("#app_logo").removeClass('bg-danger text-white');
			$(this).next('.text-danger').addClass('d-none');
		});

		// File input change event.
		let canSubmit = true;
		$('#app_logo').change(function(e) {
			// Change field colors.
			$("#app_logo").removeClass('bg-danger text-white');
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
					$("#logoPreview").attr('src', e.target.result);

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
					$('#logoMetadata').addClass('mt-4');

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
						$('#logoMetadata').removeClass('mt-4');

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

					$('#logoMetadata').addClass('mt-4');

					canSubmit = true;
				}
				// Display file type.
				$('#fileType').text(file.type);

				// Prevent form submission based on the flag.
				$('#appSettingForm').submit(function(e) {
					if (!canSubmit) {
						e.preventDefault();
						return alert('Logo aplikasi belum diunggah dengan benar!');
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

			$('#app_logo').val('');

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
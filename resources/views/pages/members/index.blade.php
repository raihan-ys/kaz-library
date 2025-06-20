@extends('layouts.app')
@section('title', 'Daftar Anggota')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Anggota</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-users"></i> Anggota</li>
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

					{{-- create member button --}}
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMemberModal">
						<i class="fas fa-plus"></i> Tambah Anggota
					</button>

					{{-- soft deleted members button --}}
					<a href="{{ route('anggota.trashed') }}" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i> Anggota Terhapus
					</a>

					{{-- create member modal --}}
					<div class="modal fade" id="createMemberModal">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								{{-- header --}}
								<div class="modal-header">
									<h4 class="modal-title font-weight-bold">Form Tambah Anggota</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<form id="createMemberForm" action="{{ route('anggota.store') }}" method="post" enctype="multipart/form-data">
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

										{{-- type id --}}
										<div class="form-group">
											<label for="type_id">Tipe</label>
											<select name="type_id" id="type_id" class="form-control {{ $errors->has('type_id') ? 'bg-danger text-white' : '' }}" required>
												@foreach($member_types as $type)
												<option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
												@endforeach
											</select>
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
											<input type="tel" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'bg-danger text-white' : '' }}" placeholder="Masukkan Nomor Telepon Anggota" maxlength="20" value="{{ old('phone') }}" required>
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

										{{-- profile photo --}}
										<div class="col-12">
											
											{{-- file input --}}
											<div class="form-group">
												<label for="profile_photo">Foto Profil</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="profile_photo" name="profile_photo" accept=".png">
														<label class="custom-file-label {{ $errors->has('profile_photo') ? 'bg-danger text-white' : '' }}" for="profile_photo">Pilih gambar PNG</label>
													</div>
													<div class="input-group-append">
														<span class="input-group-text" id="uploadButton">Unggah</span>
													</div>
												</div>
												{{-- cancel upload --}}
												<button type="button" class="btn btn-danger d-none mt-2" id="cancelUpload">
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
											<div class="row d-none" id="previewContainer">
												<div class="col-3" id="imageContainer">
													<label for="photoPreview">Pratinjau Foto</label><br>
													<img id="photoPreview" src="#" alt="Member's Profile Photo Preview" class="img-fluid" style="width: 200px; height: 200px;"/>
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
									</div>
									{{-- /.body --}}

									{{-- footer --}}
									<div class="modal-footer justify-content-between btn-group">
										<button type="reset" id="resetButton" class="btn btn-outline-danger">Reset</button>
										<button type="submit" class="btn btn-outline-primary" id="createMember">Simpan</button>
									</div>
								</form>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					{{-- /.create member modal --}}

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
					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="membersTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Tipe</th>
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
								<td>{{ $member->type_name }}</td>
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
										<button type="button" class="btn btn-danger" data-member-id="{{ $member->id }}" title="Hapus" onclick="confirmDelete({{ $member->id }}, '{{ $member->full_name }}', '{{ $member->profile_photo ? asset('storage/'.$member->profile_photo) : asset('images/sample-user-photo.jpeg') }}')">
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
								<td colspan="7" class="text-center font-weight-bold text-danger py-5">Tidak ada anggota yang terdaftar!</td>
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
	// Member delete confirmation.
	function confirmDelete(memberId, memberName, memberPhoto) {
		// Call SweetAlert2's function.
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda yakin?',
			imageUrl: memberPhoto,
			imageWidth: 200,
			imageHeight: 200,
			html: 'Anggota <b>"' + memberName + '"</b> akan dihapus dari tabel ini! <span class="text-danger">Penyewaan buku oleh anggota ini juga akan dihapus!</span>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if(result.isConfirmed) {
				// Submit member's delete form.
				document.getElementById('delete-form-' + memberId).submit();
			}
		})
	};

	$(document).ready(function(){
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
				$('#createMemberForm').submit(function(e) {
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

		// Reset all input fields.
		$('#resetButton').click(function() {
			// Full name.
			$("#full_name").val('');
			$("#full_name").removeClass('bg-danger text-white');
			$("#full_name").next('.text-danger').addClass('d-none');

			// Type ID.
			$("#type_id").removeClass('bg-danger text-white');
			$("#type_id").next('.text-danger').addClass('d-none');

			// Address.
			$("#address").val('');
			$("#address").removeClass('bg-danger text-white');
			$("#address").next('.text-danger').addClass('d-none');

			// Phone.
			$("#phone").val('');
			$("#phone").removeClass('bg-danger text-white');
			$("#phone").next('.text-danger').addClass('d-none');

			// Email.
			$("#email").val('');
			$("#email").removeClass('bg-danger text-white');
			$("#email").next('.text-danger').addClass('d-none');

			// Profile photo.
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

		// Initialize DataTables to members table.
		$('#membersTable').DataTable({
			dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
			buttons: [
				'copy',
				'csv',
				'excel',
				'print',
			]
		});
	});
</script>
@endsection

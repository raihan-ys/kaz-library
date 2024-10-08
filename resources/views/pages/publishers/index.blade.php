@extends('layouts.app')
@section('title', 'Daftar Penerbit - Kaz-Library')
@section('page-header')
<div class="row">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Penerbit Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Penerbit</li>
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
				{{-- body --}}
				<div class="card-body table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Penerbit</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($publishers as $pbs)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $pbs->name }}</td>
								<td>
									{{-- delete --}}
									<button type="submit" class="delete-btn btn btn-danger" data-pbs-id="{{ $pbs->id }}" title="Hapus" id="deleteButton">
										<i class="fas fa-trash"></i>
									</button>
									<form id="delete-form-{{ $pbs->id }}" action="{{ route('penerbit.destroy', $pbs->id) }}" method="post" style="display:inline">
										@csrf
										@method('DELETE')
									</form>
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
<script>
	$(document).ready(function(){
		$('.delete-btn').on('click', function() {
			var pbsId = $(this).data('pbs-id');
			if (confirm('Apakah Anda yakin ingin menghapus penerbit ini?')) {
				$('#delete-form-' + pbsId).submit();
			}
		});
	});
</script>
@endsection

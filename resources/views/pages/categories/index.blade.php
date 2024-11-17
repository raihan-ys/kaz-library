@extends('layouts.app')
@section('title', 'Daftar Kategori - Kaz-Library')
@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Kategori Buku</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Kategori</li>
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
								<th scope="col">Kategori</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $ctg)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="font-weight-bold">{{ $ctg->name }}</td>
								<td>
									{{-- delete --}}
									<button type="submit" class="delete-btn btn btn-danger" data-ctg-id="{{ $ctg->id }}" title="Hapus" id="deleteButton">
										<i class="fas fa-trash"></i>
									</button>
									<form id="delete-form-{{ $ctg->id }}" action="{{ route('kategori.destroy', $ctg->id) }}" method="post" style="display:inline">
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
			var ctgId = $(this).data('ctg-id');
			if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
				$('#delete-form-' + ctgId).submit();
			}
		});
	});
</script>
@endsection

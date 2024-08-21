@extends('layouts.app')

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
							@php($i = 1)
							@foreach ($publishers as $pbs)
							<tr>
								<td>{{ $i++ }}</td>
								<td class="font-weight-bold">{{ $pbs->name }}</td>
								<td>
									{{-- delete --}}
									<form id="deleteForm" action="{{ route('penerbit.destroy', $pbs->id) }}" method="post" style="display:inline">
										@csrf
										@method('DELETE')
										<button type="submit" id="deleteSubmit" class="btn btn-danger" title="Hapus">
											<i class="fas fa-trash"></i>
										</button>
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

{{-- Form confirmation JS --}}
<script type="text/javascript">
	$(document).ready(function() {
		// Get elements.
		const deleteForm = $("#deleteForm");
		const deleteSubmit = $("#deleteSubmit");
		
		// Delete confirmation.
		deleteSubmit.click(function(event) {
			if(!confirm("Anda yakin ingin menghapus data ini?")) {
				event.preventDefault();
			}
		});
	});
</script>
@endsection

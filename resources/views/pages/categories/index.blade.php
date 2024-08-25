@extends('layouts.app')

@section('page-header')
<div class="row">
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
									<form id="deleteForm" action="{{ route('kategori.destroy', $ctg->id) }}" method="post" style="display:inline">
										@csrf
										@method('DELETE')
									</form>
									<button id="deleteButton" type="submit" class="btn btn-danger" title="Hapus">
										<i class="fas fa-trash"></i>
									</button>
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

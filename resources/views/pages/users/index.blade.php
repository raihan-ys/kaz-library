@extends('layouts.app')
@section('title', 'Daftar Pengguna - Kaz-Library')

@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Daftar Pengguna</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="navicon fas fa-user-friends"></i> Pengguna</li>
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
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered table-hover table-striped dataTable dtr-inline" id="usersTable">
						<thead class="text-white" style="background-color: #181C32">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Email</</th>
								<th scope="col">Dibuat Pada</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($librarians as $librarian)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="text-bold">{{ $librarian->name }}</td>
								<td>{{ $librarian->email }}</td>
								<td>{{ $librarian->created_at }}</td>
							</tr>
							@empty
							<tr>
								<td colspan="5" class="text-center font-weight-bold text-danger py-5">Tidak ada Pustakawan!</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		// Initialize DataTables to users table.
		$('#usersTable').DataTable({
			dom: 'Bfrtip',
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

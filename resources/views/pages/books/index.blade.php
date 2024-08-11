@extends('layouts.app')
@section('content')
 <div class="container">
	<h1>
		<i class="fas fa-book"></i> Daftar Buku
	</h1>
	<a href="{{ route('buku.create') }}" class="btn btn-primary mb-2">
		Tambah Buku <i class="fas fa-plus"></i>
	</a>
 	<table class="table table-striped table-hover">
		<thead class="text-white" style="background-color: #181C32">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Judul</th>
				<th scope="col">Penulis</th>
				<th scope="col">Tahun Terbit</th>
				<th scope="col">Kategori</th>
				<th scope="col">Penerbit</th>
				<th scope="col">Aksi</th>
			</tr>
		</thead>
		<tbody>
			@php($i = 1)
			@foreach ($books as $book)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $book->title }}</td>
				<td>{{ $book->author }}</td>
				<td>{{ $book->published_year }}</td>
				<td>{{ $book->category->name }}</td>
				<td>{{ $book->publisher->name }}</td>
				<td>
					{{-- show --}}
					<a href="{{ route('buku.show', $book->id) }}" class="btn btn-info" title="Detail Buku">
						<i class="fas fa-eye"></i>
					</a>
					{{-- update --}}
					<a href="{{ route('buku.edit', $book->id) }}" class="btn btn-warning" title="Edit">
						<i class="fas fa-edit"></i>
					</a>
					{{-- delete --}}
					<form action="{{ route('buku.destroy', $book->id) }}" method="post" style="display:inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">
							<i class="fas fa-trash"></i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 </div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container row card pt-5 pb-4 pl-4 pr-4">
	<h1 class="font-weight-bold text-white rounded p-2 mb-3" style="background-color: purple;">
		<i class="fas fa-book"></i>
		Detail Buku:
		{{ $book->title }}
	</h1>
	<table class="table">
		{{-- titke --}}
		<tr>
			<th scope="row">Judul</th>
			<td>{{ $book->title }}</td>
		</tr>
		{{-- author --}}
		<tr>
			<th scope="row">Penulis</th>
			<td>{{ $book->author }}</td>
		</tr>
		{{-- published_year --}}
		<tr>
			<th scope="row">Tahun Terbit</th>
			<td>{{ $book->published_year }}</td>
		</tr>
		{{-- category id --}}
		<tr>
			<th scope="row">Kategori</th>
			<td>{{ $book->category_id }}</td>
		</tr>
		{{-- publisher --}}
		<tr>
			<th scope="row">Penerbit</th>
			<td>{{ $book->publisher_id }}</td>
		</tr>
		{{-- stock --}}
		<tr>
			<th scope="row">Stok</th>
			<td>{{ $book->stock }}</td>
		</tr>
		{{-- rental price --}}
		<tr>
			<th scope="row">Biaya Peminjaman</th>
			<td>{{ $book->rental_price }}</td>
		</tr>
	</table>
</div>
@endsection

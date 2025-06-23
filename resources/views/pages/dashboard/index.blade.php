@extends('layouts.app')
@section('title', 'Dashboard')

@section('page-header')
<div class="row m-0">
	<div class="col-12">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Dashboard</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
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

		{{-- books count --}}
		<div class="col-12 col-lg-3">
			<div class="card">
				<div class="card-body d-flex flex-row">
					{{-- icon --}}
					<div class="badge badge-info p-3">
						<i class="fas fa-book" style="font-size: 20px"></i>
					</div>
					{{-- loader --}}
					<div class="text-center pl-2" id="booksCountLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- count --}}
					<div class="ml-2 d-none" id="booksCountContainer">
						<p class="mb-1">Total Buku</p>
						<b id="booksCount"></b>
					</div>
				</div>
			</div>
		</div>

		{{-- borrowed books count --}}
		<div class="col-12 col-lg-3">
			<div class="card">
				<div class="card-body d-flex flex-row">
					{{-- icon --}}
					<div class="badge badge-success p-3">
						<i class="fas fa-address-book" style="font-size: 20px"></i>
					</div>
					{{-- loader --}}
					<div class="text-center pl-2" id="borrowedBooksCountLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- count --}}
					<div class="ml-2 d-none" id="borrowedBooksCountContainer">
						<p class="mb-1">Buku Disewa</p>
						<b 	id="borrowedBooksCount"></b>
					</div>
				</div>
			</div>
		</div>

		{{-- books returned late --}}
		<div class="col-12 col-lg-3">
			<div class="card">
				<div class="card-body d-flex flex-row">
					{{-- icon --}}
					<div class="badge badge-warning p-3">
						<i class="fas fa-calendar text-white" style="font-size: 20px"></i>
					</div>
					{{-- loader --}}
					<div class="text-center pl-2" id="booksReturnedLateCountLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- count --}}
					<div class="ml-2 d-none" id="booksReturnedLateCountContainer">
						<p class="mb-1">Buku Telat Kembali</p>
						<b id="booksReturnedLateCount"></b>
					</div>
				</div>
			</div>
		</div>

		{{-- members count --}}
		<div class="col-12 col-lg-3">
			<div class="card">
				<div class="card-body d-flex flex-row">
					{{-- icon --}}
					<div class="badge badge-danger p-3">
						<i class="fas fa-users" style="font-size: 20px"></i>
					</div>
					{{-- loader --}}
				<div class="text-center pl-2" id="membersCountLoader" style="color: orangered;">
					<p>Memuat Data...</p>
					<i class="fas fa-2x fa-sync-alt fa-spin"></i>
				</div>
					{{-- count --}}
					<div class="ml-2 d-none" id="membersCountContainer">
						<p class="mb-1">Total Anggota</p>
						<b id="membersCount"></b>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- /.row --}}

	<div class="row">

		{{-- book categories chart --}}
		<div class="col-12 col-lg-4">
			
			<div class="modal fade" id="bookCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Detail Kategori Buku</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="bookCategoriesModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- /.point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div id="bookCategoriesContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="bookCategoriesLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="bookCategoriesEmptyMessage">Tidak ada buku yang terdaftar!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.book categories chart --}}

		<div class="col-12 col-lg-4 d-flex flex-column">
			{{-- popular categories chart --}}
			<div class="flex-fill">
				{{-- point modal --}}
				<div class="modal fade" id="popularCatagoriesPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">

							{{-- header --}}
							<div class="modal-header">
								<h5 class="modal-title" id="dataPointModalLabel">Detail Kategori Buku</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							{{-- body --}}
							<div class="modal-body">
								<p id="popularCatagoriesModalContent"></p>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
				{{-- /.point modal --}}

				<div class="card" style="border-top: 5px solid #181C32">
					<div id="popularCategoriesContainer" class="card-body">
						{{-- loader --}}
						<div class="text-center my-5" id="popularCatagoriesLoader" style="color: orangered;">
							<p>Memuat Data...</p>
							<i class="fas fa-2x fa-sync-alt fa-spin"></i>
						</div>
						{{-- empty data message --}}
						<p class="text-center font-weight-bold text-danger d-none" id="popularCatagoriesEmptyMessage">Tidak ada data buku atau penyewaan!</p>
					</div>
					{{-- /.card-body --}}
				</div>
				{{-- /.card --}}
			</div>
			{{-- /.popular categories chart --}}

			{{-- books status chart --}}
			<div class="flex-fill">

				{{-- point modal --}}
				<div class="modal fade" id="bookStatusModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
	
							{{-- header --}}
							<div class="modal-header">
								<h5 class="modal-title" id="dataPointModalLabel">Status Buku</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
	
							{{-- body --}}
							<div class="modal-body">
								<p id="bookStatusModalContent"></p>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
				{{-- /.point modal --}}
	
				<div class="card">
					<div id="booksStatusContainer" class="card-body">
						{{-- loader --}}
						<div class="text-center my-5" id="bookStatusLoader" style="color: orangered;">
							<p>Memuat Data...</p>
							<i class="fas fa-2x fa-sync-alt fa-spin"></i>
						</div>
						{{-- empty data message --}}
						<p class="text-center font-weight-bold text-danger d-none" id="bookStatusEmptyMessage">Tidak ada buku yang terdaftar!</p>
					</div>
					{{-- /.card-body --}}
				</div>
				{{-- /.card --}}
			</div>
			{{-- /.books status chart --}}
		</div>

		{{-- popular books --}}
		<div class="col-12 col-lg-4">

			{{-- point modal --}}
			<div class="modal fade" id="popularBooksModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Status Buku</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="popularBooksModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- /.point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-body" id="popularBooksContainer">
					{{-- loader --}}
					<div class="text-center my-5" id="popularBooksLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="popularBooksEmptyMessage">Tidak ada data buku atau penyewaan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		
	</div>
	{{-- /.row --}}

	<div class="row">
		{{-- borrowings per month line chart --}}
		<div class="col-12 col-lg-4">

			{{-- point modal --}}
			<div class="modal fade" id="borrowingsPerMonthPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Detail Peminjaman</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="borrowingsPerMonthModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- /.point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-body" id="borrowingsPerMonthContainer">
					{{-- loader --}}
					<div class="text-center my-5" id="borrowingsPerMonthLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="borrowingsPerMonthEmptyMessage">Tidak ada data buku atau penyewaan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.borrowings per month line chart --}}

		{{-- borrowings per category bar chart --}}
		<div class="col-12 col-lg-4">

			{{-- point modal --}}
			<div class="modal fade" id="borrowingsPerCategoryPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Detail Kategori Buku</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="borrowingsPerCategoryModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- /.point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div id="borrowingsPerCategoryContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="borrowingsPerCategoryLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="borrowingsPerCategoryEmptyMessage">Tidak ada data buku atau penyewaan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.borrowings per category bar chart --}}

		{{-- members per type pie chart --}}
		<div class="col-12 col-lg-4">
			{{-- point modal --}}
			<div class="modal fade" id="membersPerTypePointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Detail Jumlah Anggota</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="membersPerTypeModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div id="membersPerTypeContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="membersPerTypeLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="membersPerTypeEmptyMessage">Tidak ada anggota yang terdaftar!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.members per type pie chart--}}

	</div>
	{{-- /.row --}}

	<div class="row">

		{{-- latest borrowing table --}}
		<div class="col-12 col-lg-6">
			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-header d-flex justify-content-between align-items-center">
					<b style="text-align: left; font-size: 20px">Penyewaan Terbaru</b>
					<a href="{{ route('penyewaan') }}" class="text-bold ml-auto" style="font-size: 20px">Lihat Semua</a>
				</div>
				<div id="latestBorrowingContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="latestBorrowingLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="latestBorrowingEmptyMessage">Tidak ada data buku atau penyewaan!</p>
					{{-- table --}}
					<table class="table table-bordered table-striped table-responsive d-none" id="latestBorrowingTableContent">
						<thead style="background-color: #181C32; color: white">
							<tr>
								<th class="w-100">Buku</th>
								<th class="w-100">Penyewa</th>
								<th class="w-100">Tgl. Pinjam</th>
								<th class="w-100">Aksi</th>
							</tr>
						</thead>
						<tbody id="latestBorrowingTableBody"></tbody>
					</table>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.latest borrowing table --}}

		{{-- returned late books table --}}
		<div class="col-12 col-lg-6">
			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-header d-flex justify-content-between align-items-center">
					<b style="text-align: left; font-size: 20px">Pengembalian Terlambat</b>
					<select id="returnedLateorderSelect" class="form-control w-auto ml-auto">
						<option value="latest">Terbaru</option>
						<option value="oldest">Terlama</option>
					</select>
				</div>
				<div id="booksReturnedLateContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="booksReturnedLateLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold d-none" id="booksReturnedLateEmptyMessage" style="color: orangered;">Tidak ada pengembalian terlambat!</p>
					{{-- table --}}
					<table class="table table-bordered table-hover table-striped table-responsive d-none" id="booksReturnedLateTableContent" style="width">
						<thead style="background-color: #181C32; color: white">
							<tr>
								<th class="w-100">Buku</th>
								<th class="w-100">Penyewa</th>
								<th class="w-100">Telat</th>
								<th class="w-100">Denda</th>
								<th class="w-100">Aksi</th>
							</tr>
						</thead>
						<tbody id="booksReturnedLateTableBody"></tbody>
					</table>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.returned late books table --}}

	</div>
	{{-- /.row --}}

	<div class="row">

		{{-- total borrowers chart --}}
		<div class="col-12 col-lg-6">

			{{-- point modal --}}
			<div class="modal fade" id="totalBorrowersPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Detail Pendapatan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="totalBorrowersModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- /.point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-body" id="totalBorrowersContainer">
					{{-- loader --}}
					<h5 class="text-center">Coming Soon!</h5>
					<div class="text-center my-5" id="totalBorrowersLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="totalBorrowersMessage">Tidak ada data pendapatan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.total borrowers chart --}}

		{{-- total income chart --}}
		<div class="col-12 col-lg-6">

			{{-- point modal --}}
			<div class="modal fade" id="totalIncomePointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">

						{{-- header --}}
						<div class="modal-header">
							<h5 class="modal-title" id="dataPointModalLabel">Detail Pendapatan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						{{-- body --}}
						<div class="modal-body">
							<p id="totalIncomeModalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			{{-- /.point modal --}}

			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-body" id="totalIncomeContainer">
					<h5 class="text-center">Coming Soon!</h5>
					{{-- loader --}}
					<div class="text-center my-5" id="totalIncomeLoader" style="color: orangered;">
						<p>Memuat Data...</p>
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="totalIncomeMessage">Tidak ada data pendapatan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.total income chart --}}
	</div>
	{{-- /.row --}}
</div>
@endsection

@section('js')
{{-- Highcharts JS --}}
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/modules/exporting.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/modules/accessibility.js') }}"></script>
<script>

	$(document).ready(function() {
		// Format number to Indonesian Rupiah.
		const formatRp = number => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);

		function getDashboardData() {
			// Fetch data for books count.
			$.ajax({
				url: "{{ route('dashboard.data.books_count', [], true) }}",
				method: "GET",
				success: function(response) {
					// Set books count.
					$("#booksCount").text(response.booksCount);
					$("#borrowedBooksCount").text(response.borrowedBooksCount);
					$("#booksReturnedLateCount").text(response.booksReturnedLateCount);

					// Hide loader.
					$("#booksCountLoader").hide();
					$("#borrowedBooksCountLoader").hide();
					$("#booksReturnedLateCountLoader").hide();

					// Show containers.
					$("#booksCountContainer").removeClass('d-none');
					$("#borrowedBooksCountContainer").removeClass('d-none');
					$("#booksReturnedLateCountContainer").removeClass('d-none');
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$("#booksCountLoader").hide();
					$("#borrowedBooksCountLoader").hide();
					$("#booksReturnedLateCountLoader").hide();
				}
			});

			// Fetch data for members count.
			$.ajax({
				url: "{{ route('dashboard.data.members_count', [], true) }}",
				method: "GET",
				success: function(response) {
					// Set members count.
					$("#membersCount").text(response.membersCount);

					// Hide loader.
					$("#membersCountLoader").hide();

					// Show container.
					$("#membersCountContainer").removeClass('d-none');
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$("#membersCountLoader").hide();
				}
			});

			// Fetch data for book categories chart.
			$.ajax({
				url: "{{ route('dashboard.data.books_by_category', [], true) }}",
				method: "GET",
				success: function(response) {
					const booksByCategory = response.booksByCategory.map(item => ({
						name: item.ctg_name,
						y: item.count
					}));

					// Check if there's categories data.
					if(booksByCategory < 1) {
						// Hide loader.
						$("#bookCategoriesLoader").hide();

						// Show empty data message.
						$("#bookCategoriesEmptyMessage").removeClass('d-none');
					} else {
						// Create donut chart.
						Highcharts.chart('bookCategoriesContainer', {
							chart: {
								type: 'pie',
								height: 561
							},
							title: {
								text: 'Kategori Buku',
								style: {
									fontFamily: 'Poppins, sans-serif',
								}
							},
							plotOptions: {
								pie: {
									innerSize: '50%',
									cursor: 'pointer',
									allowPointSelect: true,
									dataLabels: { enabled: false },
									showInLegend: true,
									point: {
										events: {
											click: function() {
												// Set modal content.
												$('#bookCategoriesModalContent').html('Kategori: <b>' + this.name + '</b> <br> Jumlah: <b>' + this.y + '</b>');
												$('#bookCategoriesModal').modal('show');
											}
										}
									}
								},
							},
							series: [{
								name: 'Jumlah Buku',
								data: booksByCategory,
							}],
							credits: {
								enabled: false
							},
							tooltip: {
								formatter: function() {
									return 'Kategori: <b>' + this.point.name + '</b><br>Jumlah: <b>' + this.point.y + '</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							legend: {
								itemStyle: {
									fontFamily: 'Poppins, sans-serif',
									fontSize: '15px',
									color: '#000000'
								}
							}
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('#bookCategoriesLoader').hide();
				}
			});

			// Fetch data for popular categories chart.
			$.ajax({
				url: "{{ route('dashboard.data.popular_categories', [], true) }}",
				method: "GET",
				success: function(response) {
					const popularCategoriesKeys = response.popularCategoriesKeys;
					const popularCategoriesValues = response.popularCategoriesValues;

					// Check if there's popular categories data.
					if(popularCategoriesKeys < 1) {
						// Hide loader.
						$("#popularCatagoriesLoader").hide();

						// Show empty data message.
						$("#popularCatagoriesEmptyMessage").removeClass('d-none');
					} else {
						// Create bar chart.
						Highcharts.chart('popularCategoriesContainer', {
							chart: {
								type: 'bar',
								height: 250
							},
							title: {
								text: 'Kategori Terpopuler',
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							xAxis: {
								// X Axis categories.
								categories: popularCategoriesKeys,
								labels: {
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							yAxis: {
								// Y Axis title.
								title: {
									text: 'Jumlah Peminjaman',
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							plotOptions: {
								series: {
									cursor: 'pointer'
								}
							},
							credits: {
								enabled: false
							},
							tooltip: {
								formatter: function() {
									return 'Kategori: <b>' + this.x + '</b> <br> Dipinjam: <b>' + this.y + ' kali</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							legend: {
								itemStyle: {
									fontFamily: 'Poppins, sans-serif',
									fontSize: '12px',
									color: '#000000'
								}
							},
							series: [{
								// Data series.
								name: 'Kategori',
								data: popularCategoriesValues,
								color: '#90EE90',
								point: {
									events: {
										click: function() {
											// Set modal content.
											$('#borrowingsPerCategoryModalContent').html('Kategori: <b>' + this.category + '</b> <br> Dipinjam: <b>' + this.y + ' kali</b>');
											$('#borrowingsPerCategoryPointModal').modal('show');
										}
									}
								},
								dataLabels: {
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							}],
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('#popularCatagoriesLoader').hide();
				}
			});

			// Fetch data for books status chart.
			$.ajax({
				url: "{{ route('dashboard.data.books_status', [], true) }}",
				method: "GET",
				success: function(response) {
					const booksStatus = [
						{ name: 'Tersedia', y: response.availableBooksCount },
						{ name: 'Dipinjam', y: response.borrowedBooksCount }
					];

					// Check if there's books data.
					const totalBooks = booksStatus.reduce((acc, point) => acc + point.y, 0);
					if(totalBooks < 1) {
						// Hide loader.
						$("#bookStatusLoader").hide();

						// Show empty data message.
						$("#bookStatusEmptyMessage").removeClass('d-none');
					} else {
						// Calculate the percentage of available books.
						const totalBooks = booksStatus.reduce((acc, point) => acc + point.y, 0);
						const availableBooks = booksStatus.find(point => point.name === 'Tersedia').y;
						const percentageAvailable = ((availableBooks / totalBooks) * 100).toFixed(2);

						// Create donut chart.
						Highcharts.chart('booksStatusContainer', {
							chart: {
								type: 'pie',
								height: 250
							},
							title: {
								text: 'Status Buku',
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							subtitle: {
								text: '<b>' + percentageAvailable + '%</b><br> Tersedia',
								verticalAlign: 'middle',
								style: {
									fontFamily: 'Poppins, sans-serif',
									color: '#000000'
								}
							},
							plotOptions: {
								pie: {
									innerSize: '70%',
									cursor: 'pointer',
									dataLabels: { enabled: false },
									showInLegend: true,
									size: 150,
									point: {
										events: {
											click: function() {
												// Set modal content.
												$('#bookStatusModalContent').html('Status: <b>' + this.name + '</b> <br> Jumlah: <b>' + this.y + '</b>');
												$('#bookStatusModal').modal('show');
											}
										}
									}
								},
							},
							series: [{
								name: 'Jumlah Buku',
								data: booksStatus
							}],
							credits: {
								enabled: false
							},
							tooltip: {
								formatter: function() {
									return 'Status: <b>' + this.point.name + '</b><br>Jumlah: <b>' + this.point.y + '</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							legend: {
								itemStyle: {
									fontFamily: 'Poppins, sans-serif',
									fontSize: '15px',
									color: '#000000'
								}
							}
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('#booksStatusLoader').hide();
				}
			});

			// Fetch data for popular books chart.
			$.ajax({
				url: "{{ route('dashboard.data.get_popular_books', [], true) }}",
				method: "GET",
				success: function(response) {
					const popularBooksKeys = response.popularBooksKeys;
					const popularBooksValues = response.popularBooksValues;

					// Check if there's popular books data.
					if(popularBooksKeys < 1) {
						// Hide loader.
						$("#popularBooksLoader").hide();

						// Show empty data message.
						$("#popularBooksEmptyMessage").removeClass('d-none');
					} else {
						// Create bar chart.
						Highcharts.chart('popularBooksContainer', {
							chart: {
								type: 'column',
								height: 561
							},
							title: {
								text: 'Buku Terpopuler',
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							xAxis: {
								// X Axis categories.
								categories: popularBooksKeys,
								labels: {
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							yAxis: {
								// Y Axis title.
								title: {
									text: 'Jumlah Peminjaman',
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							plotOptions: {
								series: {
									cursor: 'pointer',
									color: '#4B0082'
								}
							},
							credits: {
								enabled: false
							},
							tooltip: {
								formatter: function() {
									return 'Buku: <b>' + this.x + '</b> <br> Dipinjam: <b>' + this.y + ' kali</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							legend: {
								itemStyle: {
									fontFamily: 'Poppins, sans-serif',
									fontSize: '12px',
									color: '#000000'
								}
							},
							series: [{
								// Data series.
								name: 'Buku',
								data: popularBooksValues,
								point: {
									events: {
										click: function() {
											// Set modal content.
											$('#popularBooksModalContent').html('Buku: <b>' + this.category + '</b> <br> Dipinjam: <b>' + this.y + ' kali</b>');
											$('#popularBooksModal').modal('show');
										}
									}
								},
								dataLabels: {
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							}],
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('#popularBooksLoader').hide();
				}
			})

			// Fetch data for borrowings per month chart.
			$.ajax({
				url: "{{ route('dashboard.data.books_by_month', [], true) }}",
				method: "GET",
				success: function(response) {
					const borrowings = response.borrowings;
					const borrowMonths = response.months;

					// Check if there's borrowings data.
					if(borrowings < 1) {
						// Hide loader.
						$("#borrowingsPerMonthLoader").hide();

						// Show empty data message.
						$("#borrowingsPerMonthEmptyMessage").removeClass('d-none');
					} else {
						// Create line chart.
						Highcharts.chart('borrowingsPerMonthContainer', {
							chart: {
								type: 'line' 
							},
							title: {
								text: 'Jumlah Peminjaman Buku Per Bulan',
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							xAxis: {
								// X-axis categories.
								categories: borrowMonths
							},
							yAxis: {
								title: {
									// Y-axis title.
									text: 'Jumlah Peminjaman',
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							credits: {
								enabled: false
							},
							legend: {
								itemStyle: {
									fontFamily: 'Poppins, sans-serif',
									fontSize: '12px',
									color: '#000000'
								}
							},
							series: [
								{
									// Data series.
									name: 'Peminjaman',
									color: '#ff4400',
									data: borrowings,
									point: {
										events: {
											click: function() {
												// Set modal content.
												$('#borrowingsPerMonthModalContent').html('Bulan: <b>' + this.category + '</b> <br> Jumlah: <b>' + this.y + '</b>');
												$('#borrowingsPerMonthPointModal').modal('show');
											}
										}
									},
									dataLabels: {
										enabled: true,
										style: {
											fontFamily: 'Poppins, sans-serif',
											fontSize: '12px',
											color: '#000000'
										}
									}
								},
							],
							exporting: {
								enabled: true
							},
							tooltip: {
								formatter: function() {
									return 'Bulan: <b>' + this.x + '</b><br>Jumlah: <b>' + this.y + '</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
						});	
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('#borrowingsPerMonthLoader').hide();
				}
			});

			// Fetch data for borrowings per category chart.
			$.ajax({
				url: "{{ route('dashboard.data.borrowings_by_category', [], true) }}",
				method: "GET",
				success: function(response) {
					const borrowingsKeys = response.borrowingsKeys;
					const borrowingsValues = response.borrowingsValues;

					// Check if there's borrowings data.
					if(borrowingsKeys < 1) {
						// Hide loader.
						$("#borrowingsPerCategoryLoader").hide();

						// Show empty data message.
						$("#borrowingsPerCategoryEmptyMessage").removeClass('d-none');
					} else {
						// Create bar chart.
						Highcharts.chart('borrowingsPerCategoryContainer', {
							chart: {
								type: 'bar'
							},
							title: {
								text: 'Jumlah Buku yang Dipinjam per Kategori',
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							xAxis: {
								// X Axis categories.
								categories: borrowingsKeys,
								labels: {
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							yAxis: {
								// Y Axis title.
								title: {
									text: 'Jumlah Buku',
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							},
							credits: {
								enabled: false
							},
							tooltip: {
								formatter: function() {
									return 'Kategori: <b>' + this.x + '</b> <br> Jumlah: <b>' + this.y + '</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							legend: {
								itemStyle: {
									fontFamily: 'Poppins, sans-serif',
									fontSize: '12px',
									color: '#000000'
								}
							},
							series: [{
								// Data series.
								name: 'Kategori',
								data: borrowingsValues,
								color: '#ff4400',
								point: {
									events: {
										click: function() {
											// Set modal content.
											$('#borrowingsPerCategoryModalContent').html('Kategori: <b>' + this.category + '</b> <br> Jumlah: <b>' + this.y + '</b>');
											$('#borrowingsPerCategoryPointModal').modal('show');
										}
									}
								},
								dataLabels: {
									style: {
										fontFamily: 'Poppins, sans-serif'
									}
								}
							}],
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('borrowingsPerCategoryLoader').hide();
				}
			});

			// Fetch data for members per type chart.
			$.ajax({
				url: "{{ route('dashboard.data.members_by_type', [], true) }}",
				method: "GET",
				success: function(response) {
					const members = response.members;

					// Check if there's members data.
					if(members < 1) {
						// Hide loader.
						$("#membersPerTypeLoader").hide();

						// Show empty data message.
						$("#membersPerTypeEmptyMessage").removeClass('d-none');
					} else {
						// Calculate total members.
						const totalMembers = members.reduce((sum, item) => sum + item.count, 0);
						
						const data = members.map(function(item) {
							return {
								name: item.type_name,
								x: (item.count / totalMembers) * 100,
								y: item.count,
								dataLabels: {
									style: {
										fontFamily: 'Poppins, sans-serif',
										fontSize: '14p',
									}
								}	
							};
						});

						// Create pie chart.
						Highcharts.chart('membersPerTypeContainer', {
							chart: {
								type: 'pie',
							},
							title: {
								text: 'Distribusi Anggota Berdasarkan Tipe Keanggotaan',
								style: {
									fontFamily: 'Poppins, sans-serif'
								} 
							},
							tooltip: {
								formatter: function () {
									return 'Tipe: <b>' + this.key + '</b> <br> Persentase: <b>' + Math.round(this.percentage) + ' %</b> <br> Jumlah: <b>' + this.y + '</b>';
								},
								style: {
									fontFamily: 'Poppins, sans-serif'
								}
							},
							credits: {
								enabled: false
							},
							plotOptions: {
								pie: {
									cursor: 'pointer',
									dataLabels: {
										enabled: true,
										distance: -40,
										// Data labels format.
										format: '{point.percentage:.0f} %',
										style: {
											fontSize: '1em',
											fontFamily: 'Poppins, sans-serif',
											textOutline: 'none',
											opacity: 0.7
										},
										filter: {
											operator: '>',
											property: 'percentage',
											value: 10
										}
									},
									point: {
										events: {
											click: function() {
												// Set modal content.
												$('#membersPerTypeModalContent').html('Tipe: <b>' + this.name + '</b> <br> Persentase: <b>' + Math.round(this.x) + ' %</b> <br> Jumlah: <b>' + this.y + '</b>');
												$('#membersPerTypePointModal').modal('show');
											}
										}
									}
								},
							},
							series: [
								{
									name: 'Anggota',
									colorByPoint: true,
									data: data,
								}
							]
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$('membersPerTypeLoader').hide();
				}
			});

			// Fetch data for latest borrowings table.
			$.ajax({
				url: "{{ route('dashboard.data.latest_borrowings', [], true) }}",
				method: "GET",
				success: function(response) {
					const latestBorrowings = response.latestBorrowings;

					// Check if there's latest borrowings data.
					if(latestBorrowings.length < 1) {
						// Hide loader.
						$("#latestBorrowingLoader").hide();

						// Show empty data message.
						$("#latestBorrowingEmptyMessage").removeClass('d-none');
					} else {
						// Populate table.
						let tableBody = '';

						latestBorrowings.forEach(borrowing => {
							tableBody += `
								<tr>
									<td>${borrowing.book.title}</td>
									<td>${borrowing.member.full_name}</td>
									<td>${borrowing.borrow_date}</td>
									<td><a class="btn btn-info" href="{{ route('penyewaan') }}/${borrowing.id}" title="Detail"><i class="fas fa-eye"</i></a></td>
								</tr>
							`;
						});
						$("#latestBorrowingTableBody").html(tableBody);

						// Show table.
						$("#latestBorrowingTableContent").removeClass('d-none');

						// Hide loader.
						$("#latestBorrowingLoader").hide();
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error: ', error);
					// Hide loader in case of error.
					$("#latestBorrowingLoader").hide();
				}
			});

			// Fetch data for returned late books table.
			function fetchBooksReturnedLate(order) {
				$.ajax({
					url: "{{ route('dashboard.data.books_returned_late', [], true) }}",
					method: "GET",
					data: { order:order },
					success: function(response) {
						const booksReturnedLate = response.booksReturnedLate;

						// Check if there's returned late books data.
						if(booksReturnedLate.length < 1) {
							// Hide loader.
							$("#booksReturnedLateLoader").hide();

							// Show empty data message.
							$("#booksReturnedLateEmptyMessage").removeClass('d-none');
						} else {
							// Populate table.
							let tableBody = '';

							booksReturnedLate.forEach(borrowing => {
								tableBody += `
									<tr>
										<td>${borrowing.book.title}</td>
										<td>${borrowing.member.full_name}</td>
										<td><span class="badge badge-danger" style="font-size:15px">${borrowing.late_days} hari</span></td>
										<td>${formatRp(borrowing.late_fee)}</td>
										<td><a class="btn btn-info" href="{{ route('penyewaan') }}/${borrowing.id}" title="Detail"><i class="fas fa-eye"</i></a></td>
									</tr>
								`;
							});
							$("#booksReturnedLateTableBody").html(tableBody);
							// Show table.
							$("#booksReturnedLateTableContent").removeClass('d-none');
							// Hide loader.
							$("#booksReturnedLateLoader").hide();
						}
					},
					error: function(xhr, status, error) {
						console.error('AJAX Error: ', error);
						// Hide loader in case of error.
						$("#booksReturnedLateLoader").hide();
					}
				});
			}

			// Fetch data with default order.
			fetchBooksReturnedLate('latest');

			// Fetch data based on selected order.
			$("#returnedLateOrderSelect").change(function() {
				const order = $(this).val();
				fetchBooksReturnedLate(order);
			});
		}

		// Call the function to fetch data.
		setInterval(getDashboardData, 30000);

		// Initial call to fetch data.
		getDashboardData();
	});
</script>
@endsection

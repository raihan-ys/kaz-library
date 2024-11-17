@extends('layouts.app')
@section('title', 'Dashboard - Kaz-Library')

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
							<li class="breadcrumb-item active"><i class="fas fa-tachometer-alt mr-1"></i> Dashboard</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection

@section('content')
<div class="container-fluid"></div>
	<div class="row">

		{{-- line chart penyewaan buku --}}
		<div class="col-4" id="lineChartContainer">
			{{-- loader --}}
			<div class="text-center my-5" id="lineChartLoader" style="color: orangered;">
				<i class="fas fa-2x fa-sync-alt fa-spin"></i>
			</div>

			{{-- point modal --}}
			<div class="modal fade" id="dataPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
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
							<p id="modalContent"></p>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- line chart penyewaan buku --}}
	</div>
</div>
@endsection

@section('js')
{{-- Highcharts JS --}}
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/modules/exporting.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/modules/accessibility.js') }}"></script>
<script>
	// Show loader.
	$("#lineChartLoader").show();

	// Ajax Request to fetch data for line chart.
	$.ajax({
		url: "{{ route('dashboard.data.books_by_month') }}",
		method: "GET",
		success: function(response) {
			const borrowings = response.borrowings;
			const borrowMonths = response.months;

			// Create line chart.
			createLineChart('lineChartContainer', 'Jumlah Peminjaman Buku Per Bulan', borrowMonths, borrowings);

			// Hide loader.
			$("#lineChartLoader").hide();
		},
		error: function(xhr, status, error) {
			console.error('AJAX Error ', error);
			// Hide loader in case of error.
			$('#lineChartLoader').hide();
		}
	});

	// Create line chart.
	function createLineChart(container, title, categories, data) {
		Highcharts.chart(container, {
			chart: {
				// Specify chart type as line.
				type: 'line' 
			},
			title: {
				// Chart title.
				text: title
			},
			xAxis: {
				// X-axis categories.
				categories: categories
			},
			yAxis: {
				title: {
					// Y-axis title.
					text: 'Jumlah Peminjaman'
				}
			},
			credits: {
				enabled: false
			},
			series: [
				{
					// Data series.
					name: 'Peminjaman',
					color: '#ff4400',
					data: data,
					point: {
						events: {
							click: function() {
								// Set modal content.
								$('#dataPointModal').modal('show');
								$('#modalContent').text('Bulan ' + this.category + ', Jumlah:' + this.y);
							}
						}
					}
				}
			],
			exporting: {
				enabled: true
			},
			tooltip: {
				formatter: function() {
					return 'Bulan: ' + this.x + '<br>Jumlah: ' + this.y;
			}
			},
		});	
	}
</script>
@endsection

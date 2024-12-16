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

		{{-- line chart point modal --}}
		<div class="modal fade" id="lineChartPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
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
						<p id="lineChartModalContent"></p>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		{{-- /.line chart point modal --}}

		{{-- bar chart point modal --}}
		<div class="modal fade" id="barChartPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">

					{{-- header --}}
					<div class="modal-header">
						<h5 class="modal-title" id="dataPointModalLabel">Detail Peminjaman Buku</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					{{-- body --}}
					<div class="modal-body">
						<p id="barChartModalContent"></p>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		{{-- /.bar chart point modal --}}

		{{-- pie chart point modal --}}
		<div class="modal fade" id="pieChartPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel" aria-hidden="true">
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
						<p id="pieChartModalContent"></p>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		{{-- /.pie chart point modal --}}

		{{-- line chart penyewaan buku --}}
		<div class="col-12 col-lg-4">
			<div class="card" style="border-top: 5px solid #181C32">
				<div class="card-body" id="lineChartContainer">
					{{-- loader --}}
					<div class="text-center my-5" id="lineChartLoader" style="color: orangered;">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="lineChartEmptyMessage">Tidak ada data buku atau penyewaan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.line chart penyewaan buku --}}

		{{-- bar chart jumlah peminjaman --}}
		<div class="col-12 col-lg-4">
			<div class="card" style="border-top: 5px solid #181C32">
				<div id="barChartContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="barChartLoader" style="color: orangered;">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="barChartEmptyMessage">Tidak ada data buku atau penyewaan!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.bar chart jumlah peminjaman --}}

		{{-- pie chart distribusi anggota --}}
		<div class="col-12 col-lg-4">
			<div class="card" style="border-top: 5px solid #181C32">
				<div id="pieChartContainer" class="card-body">
					{{-- loader --}}
					<div class="text-center my-5" id="pieChartLoader" style="color: orangered;">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					{{-- empty data message --}}
					<p class="text-center font-weight-bold text-danger d-none" id="pieChartEmptyMessage">Tidak ada anggota yang terdaftar!</p>
				</div>
				{{-- /.card-body --}}
			</div>
			{{-- /.card --}}
		</div>
		{{-- /.pie chart distribusi anggota --}}

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
	// Show loader.
	$("#lineChartLoader").show();
	$("#barChartLoader").show();
	$("#pieChartLoader").show();

	// Ajax Request to fetch data for line chart.
	$.ajax({
		url: "{{ route('dashboard.data.books_by_month') }}",
		method: "GET",
		success: function(response) {
			const borrowings = response.borrowings;
			const borrowMonths = response.months;

			// Check if there's borrowings data.
			if(borrowings < 1) {
				// Hide loader.
				$("#lineChartLoader").hide();

				// Show empty data message.
				$("#lineChartEmptyMessage").removeClass('d-none');
			} else {
				// Create line chart.
				createLineChart('lineChartContainer', 'Jumlah Peminjaman Buku Per Bulan', borrowMonths, borrowings);

				// Hide loader.
				$("#lineChartLoader").hide();
			}
		},
		error: function(xhr, status, error) {
			console.error('AJAX Error ', error);
			// Hide loader in case of error.
			$('#lineChartLoader').hide();
		}
	});

	// Ajax Request to fetch data for bar chart.
	$.ajax({
		url: "{{ route('dashboard.data.borrowings_by_category') }}",
		method: "GET",
		success: function(response) {
			const borrowingsKeys = response.borrowingsKeys;
			const borrowingsValues = response.borrowingsValues;

			// Check if there's borrowings data.
			if(borrowingsKeys < 1) {
				// Hide loader.
				$("#barChartLoader").hide();

				// Show empty data message.
				$("#barChartEmptyMessage").removeClass('d-none');
			} else {
				// Create bar chart.
				createBarChart('barChartContainer', 'Jumlah Buku yang Dipinjam per Kategori', borrowingsKeys, borrowingsValues);

				// Hide loader.
				$("#barChartLoader").hide();
			}
		},
		error: function(xhr, status, error) {
			console.error('AJAX Error ', error);
			// Hide loader in case of error.
			$('barChartLoader').hide();
		}
	});

	// Ajax Request to fetch data for pie chart.
	$.ajax({
		url: "{{ route('dashboard.data.members_by_type') }}",
		method: "GET",
		success: function(response) {
			const members = response.members;

			// Check if there's members data.
			if(members < 1) {
				// Hide loader.
				$("#pieChartLoader").hide();

				// Show empty data message.
				$("#pieChartEmptyMessage").removeClass('d-none');
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
				createPieChart('pieChartContainer', 'Distribusi Anggota Berdasarkan Tipe Keanggotaan', data);

				// Hide loader.
				$("#pieChartLoader").hide();
			}
		},
		error: function(xhr, status, error) {
			console.error('AJAX Error ', error);
			// Hide loader in case of error.
			$('pieChartLoader').hide();
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
				text: title,
				style: {
					fontFamily: 'Poppins, sans-serif'
				}
			},
			xAxis: {
				// X-axis categories.
				categories: categories
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
				// Customize series name.
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
					data: data,
					point: {
						events: {
							click: function() {
								// Set modal content.
								$('#lineChartModalContent').html('Bulan: <b>' + this.category + '</b> <br> Jumlah: <b>' + this.y + '</b>');
								$('#lineChartPointModal').modal('show');
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

	// Create bar chart.
	function createBarChart(container, title, categories, data) {
		Highcharts.chart(container, {
			chart: {
				// Specify chart type as bar.
				type: 'bar'
			},
			title: {
				// Set chart title.
				text: title,
				style: {
					fontFamily: 'Poppins, sans-serif'
				}
			},
			xAxis: {
				// X Axis categories.
				categories: categories,
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
				// Customize series name.
				itemStyle: {
					fontFamily: 'Poppins, sans-serif',
					fontSize: '12px',
					color: '#000000'
				}
			},
			series: [{
				// Data series.
				name: 'Kategori',
				data: data,
				color: '#ff4400',
				point: {
					events: {
						click: function() {
							// Set modal content.
							$('#barChartModalContent').html('Kategori: <b>' + this.category + '</b> <br> Jumlah: <b>' + this.y + '</b>');
							$('#barChartPointModal').modal('show');
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

	// Create pie chart.
	function createPieChart(container, title, data) {
		Highcharts.chart(container, {
			chart: {
				// Set the chart type as pie.
				type: 'pie',
			},
			title: {
				// Set the chart title.
				text: title,
				style: {
					fontFamily: 'Poppins, sans-serif'
				} 
			},
			tooltip: {
				// Tooltip format.
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
				series: {
					allowPointSelect: true,
					cursor: 'pointer',
					point: {
						events: {
							click: function() {
								// Set modal content.
								$('#pieChartModalContent').html('Tipe: <b>' + this.name + '</b> <br> Persentase: <b>' + Math.round(this.x) + ' %</b> <br> Jumlah: <b>' + this.y + '</b>');
								$('#pieChartPointModal').modal('show');
							}
						}
					},
					dataLabels: [
						{
							enabled: true,
							distance: 20	
						}, 
						{
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
						}
					]
				}
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
</script>
@endsection

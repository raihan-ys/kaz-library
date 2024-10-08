@extends('layouts.app')
@section('title', 'Dashboard - Kaz-Library')
@section('page-header')
<div class="row">
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
<div id="container">

</div>
@endsection

@section('js')
{{-- Highcharts JS --}}
<script type="text/javascript" src="{{ asset('vendor/highcharts/code/highcharts.js') }}"></script>
<script>
	// Type of the chart
	Highcharts.chart('container', {
		chart: {
			type: 'line'
		},
		// Title of the chart
		title: {
			text: 'Sample Line Chart'
		},
		// Categories for the X-axis
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		// Title for the Y-axis
		yAxis: {
			title: {
			text: 'Value'
		}
 	},
	// Name of the data series
	series: [{
		name: 'Year 2023',
		// Data points
		data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,194.1, 95.6, 54.4] 
	}]
});
</script>
@endsection

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Laporan Penjualan dan Pendapatan</title>

	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
	
</head>
<body>
	<h3 class="text-center">Laporan Total Pendapatan</h3>
	<h4 class="text-center">Tanggal {{ tanggal_indonesia($tanggal_awal) }} s/d {{ tanggal_indonesia($tanggal_akhir) }}</h4>

	<hr>

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal</th>
				<th>Penjualan</th>
				<th>Pengeluaran</th>
				<th>Pendapatan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $row)    
			<tr>
				@foreach($row as $col)
				<td>{{ $col }}</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
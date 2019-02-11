<!DOCTYPE html>
<html>
<head>
	<title>Apotek KIM FARMA</title>
</head>
<body>
<center>
	<h2>Apotek KIM FARMA</h2>
</center>
<hr>
<table width="100%" border="0.5">
	<tr>
		<td>No Batch</td>
		<td>Nama Barang</td>
		<td>Satuan</td>
		<td>Diskon</td>
		<td>Harga Beli</td>
		<td>Harga Jual</td>
		<td>Harga Resep</td>
		<td>Stok</td>
	</tr>
	@foreach ($barangs as $barang)
	<tr>
		<td>{{ $barang->no_batch }}</td>
		<td>{{ $barang->nama_barang }}</td>
		<td>{{ $barang->nama_satuan }}</td>
		<td align="right">{{ $barang->diskon." %" }}</td>
		<td align="right">Rp. {{ format_uang($barang->harga_beli) }}</td>
		<td align="right">Rp. {{ format_uang($barang->harga_jual) }}</td>
		<td align="right">Rp. {{ format_uang($barang->harga_resep) }}</td>
		<td align="right">{{ $barang->stok }}</td>
	</tr>
	@endforeach
</table>
</body>
</html>
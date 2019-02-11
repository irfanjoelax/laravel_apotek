@extends('layouts.master')

@section('content')
	<div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data Penjualan
                        <div class="pull-right">
                        	<a href="{{ route('transaksi.new') }}" class="btn btn-primary">TAMBAH</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered" id="table-penjualan">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
                                <th>Operator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	{{-- @include('admin.penjualan.detail') --}}
@endsection

@section('script')
	<script type="text/javascript">

		// deklarasi variabel
		var table, save_method, table_detail;

		// fungsi penggunaan jquery: load datatable
		$(document).ready(function(){
			// load DataTable
			table = $('#table-penjualan').DataTable({
				"processing": true,
				"serverside": true,
				"ajax": {
					"url": "{{ route('penjualan.data') }}",
					"type": "GET",
				}
			});

			table_detail = $('#table-detail').DataTable({
				"dom": 'Brt',
				"bSort": false,
				"processing": true,
				"dataType": 'JSON'
			});


			$('#table-supplier').DataTable();
		});

		// fungsi memunculkan modal dialog form
		function addForm(){
			$('#modal-supplier').modal('show');
		}

		// fungsi untuk memunculkan detail penjualan
		function showDetail(id){
			$('#modal-detail').modal('show');
			$('#table-detail').DataTable().ajax.url("penjualan/show"/+id);
			$('#table-detail').DataTable().ajax.reload();
		}

		// fungi untuk menghapus data penjualan
		function deleteData(id){
			if (confirm("Apakah yakin ingin menghapus data ?")) {
				$.ajax({
					url: "penjualan/"+id,
					type: "POST",
					data: {
						"_method": "DELETE",
						"_token": $('meta[name=csrf-token]').attr('content')
					},
					success: function(data){
						$('#table-penjualan').DataTable().ajax.reload();
					},
					error: function(data){
						console.log(data);
					}
				});
			}
		}
	</script>
@endsection
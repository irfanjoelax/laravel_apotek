@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data Pembelian
                        <div class="pull-right">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalSupplier"><em class="fa fa-plus"></em> TRANSAKSI BARU</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.Faktur/Nota</th>
                                <th>Tgl Faktur</th>
                                <th>Supplier</th>
                                <th>Jenis Faktur</th>
                                <th>Jth Tempo</th>
                                <th>Total Beli</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pembelian.supplier')
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.table').DataTable({
                "processing": true,
                "serverside": true,
                "ajax": {
                    "url": "{{ route('pembelian.data') }}",
                    "type": "GET",
                }
            });

            $('#table-supplier').DataTable();
        });

        function deleteItem(id){
            if (confirm("Apakah Yakin Ingin Menghapus Data Ini ?")) {
                $.ajax({
                    url: "pembelian/" +id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function(data){
                        $('.table').DataTable().ajax.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }
        }
    </script>
@endsection
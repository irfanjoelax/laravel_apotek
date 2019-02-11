@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data Barang
                        <div class="pull-right">
                            <a href="{{ route('barang.create') }}" class="btn btn-primary">TAMBAH</a>
                            <a href="{{ route('barang.excel.view') }}" class="btn btn-success">EXPORT/IMPORT EXCEL</a>
                            <a href="{{ route('barang.pdf') }}" class="btn btn-danger">IMPORT PDF</a>
                            {{-- <a href="#" id="btnImportPdf" class="btn btn-danger">IMPORT PDF</a> --}}
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No Batch</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Diskon</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Harga Resep</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/print.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // load DataTable
            $('.table').DataTable({
                "processing": true,
                "serverside": true,
                "ajax": {
                    "url": "{{ route('barang.data') }}",
                    "type": "GET",
                }
            });

            // script untuk import data ke pdf
            $('#btnImportPdf').click(function() {
                $.ajax({
                    url: '{{ route('barang.pdf') }}',
                    type: 'GET',
                    success: function(data){
                        $('#btnImportPdf').text('IMPORTING FILE...');
                    }
                })
            });
        });

        // function untuk menghapus data
        function deleteData(id){
            if (confirm("Apakah Yakin Ingin Menghapus Data Ini ?")) {
                $.ajax({
                    url: "barang/" +id,
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

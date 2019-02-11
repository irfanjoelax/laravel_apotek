@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Laporan Penjualan dan Pendapatan
                        <div class="pull-right">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-form">UBAH PERIODE</a>
                            <a href="laporan/pdf/{{ $awal }}/{{ $akhir }}" class="btn btn-danger">EXPORT PDF</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered" id="table-laporan">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Penjualan</th>
                                <th>Pengeluaran</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.laporan.form')
@endsection

@section('script')
    <script type="text/javascript">
        // deklarasi variabel
        var table, awal, akhir;

        // deklarasi fungsi untuk menjalankan jquery
        $(document).ready(function(){
            // fungsi me load table dengan datatable
            table = $('#table-laporan').DataTable({
                "dom": "Brt",
                "bSort": false,
                "bPaginate": false,
                "processing": true,
                "serverside": true,
                "ajax": {
                    "url": "laporan/data/{{ $awal }}/{{ $akhir }}",
                    "type": "GET",
                }
            });
        });

    </script>
@endsection
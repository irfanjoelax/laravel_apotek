@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Detail Data Pembelian
                        <div class="pull-right">
                            <a href="{{ route('pembelian.index') }}" class="btn btn-warning"><em class="fa fa-arrow-left"></em> KEMBALI</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
<pre>
<b>No/Kode Faktur : </b> {{ $data->no_faktur }}
<b>Supplier : </b> {{ $data->nama_supplier }}
<b>Tanggal Faktur : </b> {{ tanggal_indonesia($data->tgl_faktur,false) }}
<b>Jatuh Tempo : </b> {{ tanggal_indonesia($data->jatuh_tempo,false) }}
<b>Keterangan : </b> {{ $data->jenis_faktur }}
</pre>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        @foreach ($details as $detail)
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $detail->kode_barang }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->jumlah }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td align="right" colspan="3"><b>Total Beli Faktur</b></td>
                                <td>Rp. {{ format_uang($data->total_beli) }} ,-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
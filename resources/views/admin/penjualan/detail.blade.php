@extends('layouts.master')

@section('content')
  <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                      Data Detail Penjualan
                      <div class="pull-right">
                        <a href="{{ route('penjualan.index') }}" class="btn btn-warning"><em class="fa fa-arrow-left"></em> KEMBALI</a>
                      </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered" id="table-penjualan">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                          </tr>
                          <tbody>
                            @foreach ($details as $detail)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $detail->kode_barang }}</td>
                              <td>{{ $detail->nama_barang }}</td>
                              <td>{{ $detail->jumlah }}</td>
                              <td>{{ "Rp. ".format_uang($detail->subtotal) }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
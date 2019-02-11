@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Tambah Data Barang</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('barang.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="kode_barang" class="col-sm-2 control-label">Kode Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="{{ $kodeBarang }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_batch" class="col-sm-2 control-label">No. Batch</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="no_batch" id="no_batch" placeholder="No. Batch" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_barang" class="col-sm-2 control-label">Nama Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="satuan_id" class="col-sm-2 control-label">Satuan</label>
                            <div class="col-sm-4">
                                <select name="satuan_id" id="satuan_id" class="form-control" required>
                                    <option value="">-- Silakan Pilih Satuan --</option>
                                    @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id_satuan }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="diskon" class="col-sm-2 control-label">Diskon</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Diskon" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="harga_beli" class="col-sm-2 control-label">Harga Beli</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="harga_jual" class="col-sm-2 control-label">Harga Jual</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga Jual" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="harga_resep" class="col-sm-2 control-label">Harga Resep</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="harga_resep" id="harga_resep" placeholder="Harga Resep" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stok" class="col-sm-2 control-label">Stok</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> TAMBAH DATA</button>
                                <a href="{{ route('barang.index') }}" class="button button-outline"><em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


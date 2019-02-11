@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Tambah Data Satuan</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('satuan.update',$satuan->id_satuan) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="nama_satuan" class="col-sm-2 control-label">Nama Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" value="{{ $satuan->nama_satuan }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> SIMPAN PERUBAHAN</button>
                                <a href="{{ route('satuan.index') }}" class="button button-outline"><em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


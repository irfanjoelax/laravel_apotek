@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Ubah Data Pengeluaran</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('pengeluaran.update',$pengeluaran->id_pengeluaran) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="jenis_pengeluaran" class="col-sm-3 control-label">Jenis Pengeluaran</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jenis_pengeluaran" id="jenis_pengeluaran" value="{{ $pengeluaran->jenis_pengeluaran}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nominal" class="col-sm-3 control-label">Nominal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nominal" id="nominal" value="{{ $pengeluaran->nominal}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> SIMPAN PERUBAHAN</button>
                                <a href="{{ route('pengeluaran.index') }}" class="button button-outline"<em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Tambah Data Pengeluaran</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('pengeluaran.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="jenis_pengeluaran" class="col-sm-3 control-label">Jenis Pengeluaran</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jenis_pengeluaran" id="jenis_pengeluaran" placeholder="Jenis Pengeluaran" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nominal" class="col-sm-3 control-label">Nominal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> TAMBAH DATA</button>
                                <a href="{{ route('pengeluaran.index') }}" class="button button-outline"><em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


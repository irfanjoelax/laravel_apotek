@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Tambah Data Supplier</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('supplier.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Alamat"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telepon" class="col-sm-2 control-label">Telepon</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> TAMBAH DATA</button>
                                <a href="{{ route('supplier.index') }}" class="button button-outline"><em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


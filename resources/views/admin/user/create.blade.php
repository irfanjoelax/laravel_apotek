@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Tambah Data User</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('user.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Nama User</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama User" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="level" class="col-sm-3 control-label">Level</label>
                            <div class="col-sm-4">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">-- Silakan Pilih Level Pengguna --</option>
                                    <option value="2">User</option>
                                    <option value="1">Administrator</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> TAMBAH DATA</button>
                                <a href="{{ route('user.index') }}" class="button button-outline"> <em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


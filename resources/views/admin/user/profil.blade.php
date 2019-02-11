@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Profil User</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('ubah.profil',$user->id) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama User</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="level" class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" name="level" id="level" value="{{ $user->level}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password Baru</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="button">SIMPAN PERUBAHAN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


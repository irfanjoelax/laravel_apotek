@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>Tambah Data User</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('user.update',$user->id) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Nama User</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="level" class="col-sm-3 control-label">Level</label>
                            <div class="col-sm-4">
                                <select name="level" id="level" class="form-control" required>
                                    @if ($user->level == 1)
                                        <option value="2">User</option>
                                        <option value="1" selected>Administrator</option>
                                    @else 
                                        <option value="2" selected>User</option>
                                        <option value="1">Administrator</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password Baru</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="button"><em class="fa fa-check"></em> SIMPAN PERUBAHAN</button>
                                <a href="{{ route('user.index') }}" class="button button-outline"><em class="fa fa-remove"></em> BATAL</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


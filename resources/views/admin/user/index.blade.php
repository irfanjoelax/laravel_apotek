@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data User
                        <div class="pull-right">
                            <a href="{{ route('user.create') }}" class="btn btn-primary"><em class="fa fa-plus"></em> TAMBAH</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@if ($user->level == 1) Administrator @else User @endif</td>
                                <td>
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-xs btn-warning"><em class="fa fa-edit"></em> ubah</a>
                                    <a onclick ="event.preventDefault(); document.getElementById('deleteID{{ $user->id }}').submit();" title="ubah" href="{{ route('user.destroy',$user->id) }}" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em> hapus</a>
                                    <form id="deleteID{{ $user->id }}" action="{{ route('user.destroy',$user->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }} {{ method_field('DELETE')}}
                                    </form>
                                </td>
                            </tr>
                            @include('admin.user.delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@endsection
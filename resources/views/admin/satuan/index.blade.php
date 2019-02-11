@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data Satuan
                        <div class="pull-right">
                            <a href="{{ route('satuan.create') }}" class="btn btn-primary"><em class="fa fa-plus"></em> TAMBAH</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered" id="table-satuan">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($satuans as $satuan)
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $satuan->nama_satuan }}</td>
                                <td align="center">
                                    <a href="{{ route('satuan.edit',$satuan->id_satuan) }}" class="btn btn-xs btn-warning"><em class="fa fa-edit"></em> ubah</a>
                                    <a onclick ="event.preventDefault(); document.getElementById('deleteID{{ $satuan->id_satuan }}').submit();" title="ubah" href="{{ route('satuan.destroy',$satuan->id_satuan) }}" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em> hapus</a>
                                    <form id="deleteID{{ $satuan->id_satuan }}" action="{{ route('satuan.destroy',$satuan->id_satuan) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }} {{ method_field('DELETE')}}
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @include('admin.satuan.delete')
                        @endforeach
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
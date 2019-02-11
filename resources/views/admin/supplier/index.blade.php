@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data Supplier
                        <div class="pull-right">
                            <a href="{{ route('supplier.create') }}" class="btn btn-primary"><em class="fa fa-plus"></em> TAMBAH</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $supplier->nama_supplier }}</td>
                                <td>{{ $supplier->alamat }}</td>
                                <td>{{ $supplier->telepon }}</td>
                                <td>
                                    <a href="{{ route('supplier.edit',$supplier->id_supplier) }}" class="btn btn-xs btn-warning"><em class="fa fa-edit"></em> ubah</a>
                                    <a onclick ="event.preventDefault(); document.getElementById('deleteID{{ $supplier->id_supplier }}').submit();" title="ubah" href="{{ route('supplier.destroy',$supplier->id_supplier) }}" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em> hapus</a>
                                    <form id="deleteID{{ $supplier->id_supplier }}" action="{{ route('supplier.destroy',$supplier->id_supplier) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }} {{ method_field('DELETE')}}
                                    </form>
                                </td>
                            </tr>
                            @include('admin.supplier.delete')
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
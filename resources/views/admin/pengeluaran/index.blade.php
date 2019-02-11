@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Data Pengeluaran
                        <div class="pull-right">
                            <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary"><em class="fa fa-plus"></em> TAMBAH</a>
                        </div>
                    </h3>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Jenis Pengeluaran</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            // load DataTable
            $('.table').DataTable({
                "processing": true,
                "serverside": true,
                "ajax": {
                    "url": "{{ route('pengeluaran.data') }}",
                    "type": "GET",
                }
            });
        });

        // function untuk menghapus data
        function deleteData(id){
            if (confirm("Apakah Yakin Ingin Menghapus Data Ini ?")) {
                $.ajax({
                    url: "pengeluaran/" +id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function(data){
                        $('.table').DataTable().ajax.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }
        }
    </script>
@endsection
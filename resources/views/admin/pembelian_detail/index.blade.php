@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Transaksi Pembelian
                    </h3>
                </div>
                <div class="card-block">
                    {{-- detail supplier --}}
                    <div class="row">
                        <div class="col-md-4"><strong>Supplier:</strong> {{ $supplier->nama_supplier }}</div>
                        <div class="col-md-5"><strong>Alamat:</strong> {{ $supplier->alamat }}</div>
                        <div class="col-md-3"><strong>Telepon:</strong> {{ $supplier->telepon }}</div>
                    </div>

                    <hr>

                    {{--  cari data barang --}}
                    <form class="form-horizontal" id="form-barang" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idPembelian" id="idPembelian" value="{{ $idPembelian }}">
                        {{-- <input type="hidden" name="kode_barang" id="kode_barang"> --}}
                        {{-- <strong>Pencarian Data Barang :</strong> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Pencarian Barang :</strong>
                                <input type="text" name="kode_barang" id="kode_barang" placeholder="pencarian barang..." autofocus>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalBarang">CARI BARANG</a>
                            </div>
                            <div class="col-md-3">
                            <strong>No. Faktur/Nota :</strong>
                            <input type="text" name="no_faktur" id="no_faktur" class="form-control" autofocus>
                        </div>
                        <div class="col-md-3">
                            <strong>Tanggal Faktur :</strong>
                            <input class="form-control" type="date" name="tgl_faktur" id="tgl_faktur" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <strong>Jatuh Tempo :</strong>
                            <input class="form-control" type="date" name="jatuh_tempo" id="jatuh_tempo" value="{{ date('Y-m-d') }}">
                        </div>
                        </div>
                    </form>

                    {{-- data keranjang barang sementara --}}
                    <form id="form-keranjang">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <table class="table-pembelian">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th width="15">Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>

                    <hr>
                    <select name="jenis_faktur" id="jenis_faktur" class="col-md-3" placeholder="JENIS FAKTUR">
                        <option value="KREDIT">KREDIT</option>
                        <option value="LUNAS">LUNAS</option>
                    </select>
                    <input type="text" name="total_beli" id="total_beli" placeholder="TOTAL PEMBELIAN">
                    <input type="submit" class="button" id="simpan-pembelian" value="SIMPAN PEMBELIAN">                    
                    <a href="{{ route('pembelian_detail.cancel',$idPembelian) }}" class="button">BATALKAN</a>                   
                </div>
            </div>
        </div>
    </div>

    @include('admin.pembelian_detail.barang')
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            var table;

            // untuk modal table barang dengan datatables
            $('.table-barang').DataTable();

            // menampilkan detail pembelian barang berupa table denga DataTable
            table = $('.table-pembelian').DataTable({
                "dom": 'Brt',
                "bSort": false,
                "processing": true,
                // "serverSide": true,
                "ajax": {
                    "url": "{{ route('pembelian_detail.data',$idPembelian) }}",
                    "type": "GET",
                }
            });

            // fungsi untuk menghindari submit pada form
            $('#form-barang').submit(function(){
                return false;
            });

            $('#form-keranjang').submit(function(){
                return false;
            });

            // proses ketika kode produk atau diskon berubah
            $('#kode_barang').change(function(){
                addItem();
            });

            $('#diskon').change(function(){
                if ($(this).val() == "") $(this).val(0).select();
                loadForm($(this).val());
            });

            // jika tombol submit diklik untuk melakukan proses SIMPAN
            $('#simpan-pembelian').click(function(e){
                if ($('#no_faktur').val() == "") {
                    alert('no fatur atau nota  masih kosong !');
                    $('#no_faktur').focus();
                    return false;
                }

                if ($('#total_beli').val() == "") {
                    alert('Total Beli Faktur masih kosong !');
                    $('#total_beli').focus();
                    return false;
                }


                e.preventDefault();

                $.ajax({
                    url: "{{ route('pembelian.store') }}",
                    type: "POST",
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        idPembelian: $('#idPembelian').val(),
                        no_faktur: $('#no_faktur').val(),
                        tgl_faktur: $('#tgl_faktur').val(),
                        jatuh_tempo: $('#jatuh_tempo').val(),
                        jenis_faktur: $('#jenis_faktur').val(),
                        total_beli: $('#total_beli').val(),
                    },
                    success: function(data){
                        window.location = "{{ route('pembelian.index') }}";
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });

        });

        // fungsi untuk  memilih item barang
        function selectItem(kode){
            $('#modalBarang').modal('hide');
            $('#kode_barang').val(kode);
            addItem();
        }

        // fungsi untuk melalkukan proses penambahan detail barang ke pembelian di table Pembelian
        function addItem(){
            $.ajax({
                url : "{{ route('pembelian_detail.store') }}",
                type: "POST",
                data: $('#form-barang').serialize(),
                success: function(data){
                    $('#kode_barang').val('').focus();
                    $('.table-pembelian').DataTable().ajax.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function changeCount(id){
            inputForm   = $('#form-keranjang').serialize();
            methodToken = {
                
            };

            $.ajax({
                url: "pembelian_detail/" +id,
                type: "POST",
                data: $('#form-keranjang').serialize({
                    '_method': 'PATCH',
                    '_token': $('meta[name=csrf-token]').attr('content'),
                }),
                success: function(data){
                    $('.table-pembelian').DataTable().ajax.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function deleteItem(id){
            $.ajax({
                url: "pembelian_detail/" +id,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': $('meta[name=csrf-token]').attr('content'),
                },
                success: function(data){
                    $('.table-pembelian').DataTable().ajax.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
    </script>
@endsection
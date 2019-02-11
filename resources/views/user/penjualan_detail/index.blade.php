@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>
                        Transaksi Penjualan
                    </h3>
                </div>
                <div class="card-block">
                    <div class="row">
                        {{--  cari data barang --}}
                        <div class="col-md-12">
                            <form class="form-horizontal" id="form-barang" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="idPenjualan" id="idPenjualan" value="{{ $idPenjualan }}">
                                <div class="form-group">
                                    <label for="kode_barang" class="col-md-3 control-label">Pencarian Data Barang :</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="hidden" name="stok_barang" id="stok_barang">
                                            <input type="text" name="kode_barang" id="kode_barang" placeholder="kode barang..." autofocus>
                                            <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-barang">CARI BARANG</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- data keranjang barang sementara --}}
                    <form id="form-keranjang">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <table class="table table-striped" id="table-penjualan">
                            <thead>
                                <tr>
                                    <th width="1">No.</th>
                                    <th width="25">Kode</th>
                                    <th>Nama Barang</th>
                                    <th width="10">Jumlah</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <form class="form-horizontal" id="form-penjualan" method="POST" action="transaksi/simpan">
                                {{ csrf_field() }}
                                <input type="hidden" name="idPenjualan" id="idPenjualan" value="{{ $idPenjualan }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="bayar" id="bayar">

                                <div class="form-group">
                                    <label for="totalrp" class="col-md-6 control-label">Total</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="totalrp" id="totalrp" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="diskon" class="col-md-6 control-label">Diskon</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="diskon" id="diskon" value="0" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bayarrp" class="col-md-6 control-label">Total Bayar</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="bayarrp" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="diterima" class="col-md-6 control-label">Diterima</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="diterima" id="diterima" value="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="kembali" class="col-md-6 control-label">Kembalian</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="kembali" id="kembali" value="0" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- <div class="col-md-12"> --}}
                                        <button type="submit" class="button" id="simpan-penjualan">SIMPAN PENJUALAN</button>
                                        <a href="{{ route('penjualan.cancel',$idPenjualan) }}" class="button">BATAL</a>
                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div id="tampil-bayar" style="background: lightgreen; color: #fff; font-size: 60px; text-align: center; height: 100px; "></div>
                            <div id="tampil-terbilang" style="background: yellow; color: lightblack; text-align: center; font-size: 15px; padding: 5px;"></div>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>

    @include('user.penjualan_detail.barang')
@endsection

@section('script')
    <script type="text/javascript">
        // deklarasi variable
        var table;

        // deklarasi penggunaan jquery
        $(function(){
            // untuk modal table barang dengan datatables
            $('.table-barang').DataTable();

            // menampilkan detail penjualan barang berupa table denga DataTable
            table = $('#table-penjualan').DataTable({
                "dom": 'Brt',
                "bSort": false,
                "processing": true,
                // "serverSide": true,
                "ajax": {
                    "url": "{{ route('transaksi.data',$idPenjualan) }}",
                    "type": "GET",
                    // "dataType": "JSON"
                }
            }).on('draw.dt',function(){
                // menjalankan fungsi loadForm agar setiap table di reload
                loadForm($('#diskon').val());
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


            // proses ketika terjadi perubahan value pada id diterima
            $('#diterima').change(function(){
                if ($(this).val() == "") $(this).val(0).select();
                loadForm($('#diskon').val(), $(this).val());
            }).focus(function(){
                $(this).select();
            });

            // jika tombol submit diklik untuk melakukan proses SIMPAN
            $('#simpan-penjualan').click(function(){
                $('#form-penjualan').submit();
            });

        });

        // fungsi untuk  memilih item barang
        function selectItem(kode,stok){
            $('#modal-barang').modal('hide');
            $('#kode_barang').val(kode);
            $('#stok_barang').val(stok);
            if ($('#stok_barang').val() == 0 ) {
                alert("jumlah stok tidak terpenuhi");
                $('#kode_barang').val('');
                return false;
            }

            addItem();
        }

        // fungsi untuk melalkukan proses penambahan detail barang ke pembelian di table Pembelian
        function addItem(){
            $.ajax({
                url : "{{ route('transaksi.store') }}",
                type: "POST",
                data: $('#form-barang').serialize(),
                success: function(data){
                    $('#kode_barang').val('').focus();
                    $('#table-penjualan').DataTable().ajax.reload(function(){
                        loadForm($('#diskon').val());
                    });
                },
                error: function(data){
                    alert("gagal proses addItem");
                    console.log(data);
                }
            });
        }

        function addResep(kode,stok){
            $('#modal-barang').modal('hide');
            $('#kode_barang').val(kode);
            $('#stok_barang').val(stok);

            if ($('#stok_barang').val() == 0 ) {
                alert("jumlah stok tidak terpenuhi");
                $('#kode_barang').val('');
                return false;
            }

            $.ajax({
                url : "{{ route('transaksi.store.resep') }}",
                type: "POST",
                data: $('#form-barang').serialize(),
                success: function(data){
                    $('#kode_barang').val('').focus();
                    $('#table-penjualan').DataTable().ajax.reload(function(){
                        loadForm($('#diskon').val());
                    });
                },
                error: function(data){
                    alert("gagal proses addResep");
                    console.log(data);
                }
            });
        }

        function changeCount(id,stok){

            if (stok < $('#jumlah').val() ) {
                alert("jumlah melebihi stok yang tersedia");
                $('#jumlah').val(1);
                return false;
            }

            $.ajax({
                url: "transaksi/"+id,
                type: "POST",
                data: $('#form-keranjang').serialize({
                    '_method': 'PATCH',
                    '_token': $('meta[name=csrf-token]').attr('content'),
                }),
                success: function(data){
                    $('#table-penjualan').DataTable().ajax.reload(function(){
                        loadForm($('#diskon').val());
                    });
                },
                error: function(data){
                    alert("gagal proses changeCount");
                    console.log(data);
                }
            });
        }

        function deleteItem(id){
            $.ajax({
                url: "transaksi/"+id,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': $('meta[name=csrf-token]').attr('content'),
                },
                success: function(data){
                    $('#table-penjualan').DataTable().ajax.reload(function(){
                        loadForm($('#diskon').val());
                    });
                },
                error: function(data){
                    alert("gagal proses deleteItem");
                    console.log(data);
                }
            });
        }

        function loadForm(diskon=0, diterima=0){
            $('#total').val($('.total').text());

            $.ajax({
                url: "transaksi/loadform/"+diskon+"/"+$('#total').val()+"/"+diterima,
                type: "GET",
                dataType: 'JSON',
                success: function(data){
                    $('#totalrp').val("Rp. "+data.totalrp);
                    $('#bayarrp').val("Rp. "+data.bayarrp);
                    $('#bayar').val(data.bayar);
                    $('#tampil-bayar').html("<small>Bayar:</small> Rp. "+data.bayarrp);
                    $('#tampil-terbilang').text(data.terbilang);
                    $('#kembali').val("Rp. "+data.kembalirp);
                    if ($('#diterima').val() != 0) {
                        $('#tampil-bayar').html("<small>Kembali:</small> Rp. "+data.kembalirp);
                        $('#tampil-terbilang').text(data.kembaliterbilang);
                    }
                },
                error: function(data){
                    alert("gagal proses loadform");
                    console.log(data);
                }
            });
        }

    </script>
@endsection
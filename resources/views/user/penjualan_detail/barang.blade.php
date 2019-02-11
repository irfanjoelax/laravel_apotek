  <div class="modal fade" id="modal-barang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-lg">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Data Barang</h4>
        </div>
        <div class="modal-body">
          <table class="table table.striped table-barang">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Harga Resep</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barangs as $barang)
              <tr>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>Rp. {{ format_uang($barang->harga_jual) }}</td>
                <td>Rp. {{ format_uang($barang->harga_resep) }}</td>
                <td>{{ $barang->stok }}</td>
                <td>
                  <a onclick="selectItem('{{ $barang->kode_barang }}','{{ $barang->stok}}')" class="btn btn-xs btn-info">UMUM</a>
                  <a onclick="addResep('{{ $barang->kode_barang }}','{{ $barang->stok}}')" class="btn btn-xs btn-success">RESEP</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <th>Harga Beli</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barangs as $barang)
              <tr>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->harga_beli }}</td>
                  <td><a onclick="selectItem('{{ $barang->kode_barang }}')" class="btn btn-primary">PILIH</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

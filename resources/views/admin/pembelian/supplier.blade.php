  <div class="modal fade" id="modalSupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Data Supplier</h4>
      </div>
      <div class="modal-body">
        <table id="table-supplier">
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
                <td><a href="{{ route('pembelian.create.id',$supplier->id_supplier) }}" class="btn btn-primary">PILIH</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
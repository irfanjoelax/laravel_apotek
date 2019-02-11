<form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST">
  {{ csrf_field() }} {{ method_field('DELETE') }}
  <div class="modal fade" id="{{ $barang->id_barang }}modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Data</h4>
      </div>
      <div class="modal-body">
        <strong>Apakah Anda Yakin Ingin Menghapus data ini <h3>{{ $barang->nama_barang }} ?</h3> </strong>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger"><em class="fa fa-check"></em> HAPUS</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal"><em class="fa fa-remove"></em> TUTUP</button>
      </div>
    </div>
  </div>
</div>
</form>
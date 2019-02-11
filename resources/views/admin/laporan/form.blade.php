<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('laporan.refresh') }}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Periode Laporan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="awal" class="col-md-4 control-label">Tanggal Awal</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="awal" id="awal" placeholder="Awal Periode" required>
            </div>
          </div>
          <div class="form-group">
            <label for="akhir" class="col-md-4 control-label">Tanggal Akhir</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="akhir" id="akhir" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SELESAI</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">TUTUP</button>
        </div>
      </form>
    </div>
  </div>
</div>
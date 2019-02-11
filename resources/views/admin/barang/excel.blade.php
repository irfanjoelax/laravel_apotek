@extends('layouts.master')

@section('content')
    <div class="row grid-responsive">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <h3>EXPORT / IMPORT DATA EXCEL</h3>
                </div>
                <div class="card-block">
                    <form class="form-horizontal" action="{{ route('barang.excel.import') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="import" class="col-md-2 control-label">EXPORT</label>
                          <div class="col-md-6">
                            <a href="{{ route('barang.excel.export') }}" class="btn btn-lg btn-success">Submit</a>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="import" class="col-md-2 control-label">IMPORT</label>
                          <div class="col-md-6">
                            <input id="import" type="file" class="form-control" name="import">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-2">
                            <input type="submit" value="SUBMIT" class="btn btn-primary">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


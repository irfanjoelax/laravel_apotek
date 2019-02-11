@extends('layouts.master')

@section('content')
<div class="row grid-responsive">
    <div class="column page-heading">
        <div class="large-card">
            <div align="center">
                <h1>Selamat Datang </h1>
                <p class="text-large">
                    Anda berhasil login sebagai Operator
                </p>
                <a href="{{ route('transaksi.new') }}" class="btn btn-lg btn-info">Transaksi Baru</a>
            </div>
        </div>
    </div>
</div>

<p class="credit">HTML5 Admin Template by <a href="#">Medialoot</a> And Edited by <a href="">M Irfan Permana</a></p>
@endsection

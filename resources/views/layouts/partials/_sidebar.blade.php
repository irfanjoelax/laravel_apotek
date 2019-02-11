<div id="sidebar" class="column">
    @if (Auth::user()->level == 1)
    <ul>
        <li><a href="{{ route('home') }}"><em class="fa fa-home"></em> Beranda</a></li>
        <li><a href="{{ route('satuan.index') }}"><em class="fa fa-bar-chart"></em> Satuan</a></li>
        <li><a href="{{ route('barang.index') }}"><em class="fa fa fa-cubes"></em> Barang</a></li>
        <li><a href="{{ route('supplier.index') }}"><em class="fa fa-industry"></em> Supplier</a></li>
        <li><a href="{{ route('user.index') }}"><em class="fa fa-user"></em> User</a></li>
        <li><a href="{{ route('penjualan.index') }}"><em class="fa fa-cart-plus"></em> Penjualan</a></li>
        <li><a href="{{ route('pembelian.index') }}"><em class="fa fa-cart-arrow-down"></em> Pembelian</a></li>
        <li><a href="{{ route('pengeluaran.index') }}"><em class="fa fa-clipboard"></em> Pengeluaran</a></li>
        <li><a href="{{ route('laporan.index') }}"><em class="fa fa-briefcase"></em> Laporan</a></li>
        <li><a href="{{ route('user.profil') }}"><em class="fa fa-cogs"></em> Profil</a></li>
        <li><a href="#" data-toggle="modal" data-target="#logout"><em class="fa fa-warning"></em> Keluar</a></li>
    </ul>
    @else 
    <ul>
        <li><a href="{{ route('home') }}"><em class="fa fa-home"></em> Beranda</a></li>
        <li><a href="{{ route('transaksi.new') }}"><em class="fa fa-cart-plus"></em> Penjualan Baru</a></li>
        <li><a href="{{ route('profil') }}"><em class="fa fa-cogs"></em> Profil</a></li>
        <li><a href="#" data-toggle="modal" data-target="#logout"><em class="fa fa-warning"></em> Keluar</a></li>
    </ul>
    @endif
    
</div>
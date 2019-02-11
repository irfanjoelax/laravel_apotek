<?php


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Routing untuk halaman admin
Route::group(['middleware' => ['web', 'cekuser:1']], function(){

	// routing satuan
	Route::resource('/satuan', 'SatuanController');

	// routing barang
	Route::resource('/barang', 'BarangController');
	Route::get('/barang-data', 'BarangController@data')->name('barang.data');
	Route::get('/barang-pdf','BarangController@importPdf')->name('barang.pdf');
	Route::get('/barang-pdf-view','BarangController@viewPdf')->name('barang.pdf.view');
	Route::get('/barang-excel-view','BarangController@excelView')->name('barang.excel.view');
	Route::get('/barang-export-excel','BarangController@exportExcel')->name('barang.excel.export');
	Route::post('/barang-import-excel','BarangController@importExcel')->name('barang.excel.import');

	// routing supplier
	Route::resource('/supplier', 'SupplierController');

	// routing pengeluaran
	Route::resource('/pengeluaran', 'PengeluaranController');
	Route::get('/pengeluaran-data', 'PengeluaranController@data')->name('pengeluaran.data');

	// routing user dan profil
	Route::resource('/user', 'UserController');
	Route::get('/user-profil', 'UserController@profil')->name('user.profil');
	Route::patch('/ubah-profil/{id}', 'UserController@ubahProfil')->name('ubah.profil');

	// routing pembelian
	Route::resource('/pembelian', 'PembelianController');
	Route::get('/pembelian-data', 'PembelianController@data')->name('pembelian.data');
	Route::get('/pembelian/create/{id}', 'PembelianController@create')->name('pembelian.create.id');
	Route::get('/pembelian/show/{id}', 'PembelianController@show')->name('pembelian.show.id');

	// routing pembelian detail
	Route::resource('/pembelian_detail', 'PembelianDetailController');
	Route::get('/pembelian_detail/data/{id}', 'PembelianDetailController@data')->name('pembelian_detail.data');
	Route::get('/pembelian_detail/cancel/{id}', 'PembelianDetailController@cancel')->name('pembelian_detail.cancel');
	Route::get('/pembelian_detail/loadform/{diskon}/{total}', 'PembelianDetailController@loadForm');

	// routing penjualan
	Route::resource('/penjualan', 'PenjualanController');
	Route::get('/penjualan-data','PenjualanController@data')->name('penjualan.data');
	Route::get('/penjualan/show/{id}', 'PenjualanController@show')->name('penjualan.show.id');

	// Routing untuk transaksi penjualan-detail
	Route::get('/transaksi/baru','PenjualanDetailController@newSession')->name('transaksi.new');
	Route::get('/transaksi/{id}/data','PenjualanDetailController@data')->name('transaksi.data');
	Route::resource('/transaksi', 'PenjualanDetailController');
	Route::post('/transaksi/resep','PenjualanDetailController@storeResep')->name('transaksi.store.resep');
	Route::post('/transaksi/simpan','PenjualanDetailController@saveData');
	Route::get('/transaksi/cancel/{id}','PenjualanDetailController@cancel')->name('penjualan.cancel');
	Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}','PenjualanDetailController@loadForm');

	// routing laporan
	Route::get('/laporan','LaporanController@index')->name('laporan.index');
	Route::post('/laporan','LaporanController@refresh')->name('laporan.refresh');
	Route::get('/laporan/data/{awal}/{akhir}','LaporanController@data');
	Route::get('/laporan/pdf/{awal}/{akhir}','LaporanController@exportPdf');

});

// Routing untuk halaman user biasa
Route::group(['middleware' => ['web', 'cekuser:2']], function(){

	// Routing untuk transaksi penjualan
	// Route::get('/transaksi/baru','PenjualanDetailController@newSession')->name('transaksi.new');
	// Route::get('/transaksi/{id}/data','PenjualanDetailController@data')->name('transaksi.data');
	// Route::resource('/transaksi', 'PenjualanDetailController');
	// Route::post('/transaksi/resep','PenjualanDetailController@storeResep')->name('transaksi.store.resep');
	// Route::post('/transaksi/simpan','PenjualanDetailController@saveData');
	// Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}','PenjualanDetailController@loadForm');

	// Routing untuk user
	Route::get('/profil', 'UserController@profil')->name('profil');
	Route::patch('/profil/{id}', 'UserController@ubahProfil')->name('profil.update');

});
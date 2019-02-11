<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model{
    protected $primaryKey	= 'id_barang';
    
    protected $fillable		= [
    	'kode_barang','no_batch','nama_barang','satuan_id','diskon','harga_beli','harga_jual','harga_resep','stok'
    ];

    public function satuan()
    {
        return $this->belongsTo('App\Satuan');
    }
}

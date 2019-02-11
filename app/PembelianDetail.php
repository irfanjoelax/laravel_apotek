<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    protected $primaryKey 	= 'id_pembelian_detail';
    protected $fillable 	= [
    	'pembelian_id','kode_barang','harga_beli','jumlah','subtotal'
    ];

}

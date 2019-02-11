<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $primaryKey	= 'id_penjualan_detail';
    protected $fillable 	= ['penjualan_id','kode_barang','harga_jual','jumlah','diskon','subtotal'];
}

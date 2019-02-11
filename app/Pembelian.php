<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $primaryKey 	= 'id_pembelian';
    protected $fillable 	= [
    	'no_faktur','tgl_faktur','jatuh_tempo','jenis_faktur','supplier_id','total_beli'
    ];

    public function supplier()
    {
    	return $this->belongsTo('App\Supplier');
    }
}

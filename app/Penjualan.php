<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $primaryKey 	= "id_penjualan";
    protected $fillable		= ['total_harga','diskon','bayar','diterima','user_id'];
}

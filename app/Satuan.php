<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $primaryKey	= 'id_satuan';
    protected $fillable		= ['nama_satuan'];

    public function barang()
    {
    	return $this->hasMany('App\Barang');
    }
}

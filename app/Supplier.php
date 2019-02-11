<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'id_supplier';
    protected $fillable   = ['nama_supplier','alamat','telepon'];

    public function pembelian()
    {
    	return $this->hasMany('App\Pembelian');
    }
}

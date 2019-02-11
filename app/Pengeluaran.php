<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable   = ['jenis_pengeluaran','nominal'];
}

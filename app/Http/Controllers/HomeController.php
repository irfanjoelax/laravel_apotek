<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Barang;
use App\Supplier;
use App\User;
use App\Penjualan;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barang     = Barang::count();
        $supplier   = Supplier::count();
        $user       = User::count();

        $awal   = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
        $akhir  = date('Y-m-d');

        $tanggal = $awal;

        $data_tanggal = array();
        $data_pendapatan = array();

        while (strtotime($tanggal) <= strtotime($akhir)) {
            $data_tanggal[] = (int)substr($tanggal, 8, 2);

            $pendapatan = Penjualan::where('created_at','LIKE',"$tanggal%")->sum('bayar');
            $data_pendapatan[] = (int)$pendapatan;

            $tanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
        }

        if (Auth::user()->level == 1) {
            return view('admin.home', compact('barang','supplier','user','awal','akhir','data_pendapatan','data_tanggal'));
        } else {
            return view('user.home');
        }
    }
}

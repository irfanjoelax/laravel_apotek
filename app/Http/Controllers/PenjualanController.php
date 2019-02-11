<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\PenjualanDetail;
use App\Barang;
use Yajra\Datatables\Datatables;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('admin.penjualan.index');
    }

    public function data()
    {
        $penjualan = Penjualan::leftJoin('users','users.id','=','penjualans.user_id')
                                    ->select('users.*', 'penjualans.*','penjualans.created_at as tanggal')
                                    ->orderBy('penjualans.id_penjualan','DESC')
                                    ->get();

        $data = array();
        foreach ($penjualan as $list) {
            $row    = array();
            $row[]  = tanggal_indonesia(substr($list->tanggal, 0, 10), false);
            $row[]  = "Rp. ".format_uang($list->total_harga);
            $row[]  = $list->diskon ."%";
            $row[]  = "Rp. ".format_uang($list->bayar);
            $row[]  = $list->name;
            $row[]  = '
                <a href="'.route('penjualan.show',$list->id_penjualan).'" class="btn btn-xs btn-warning"><em class="fa fa-eye"></em> lihat</a>
                <a onclick="deleteData('.$list->id_penjualan.')" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em> hapus</a>
            ';

            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $details = PenjualanDetail::leftJoin('barangs','barangs.kode_barang','=','penjualan_details.kode_barang')
                                        ->where('penjualan_id','=',$id)
                                        ->get();

        $no     = 1;

        return view('admin.penjualan.detail',compact('details','no'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $penjualan  = Penjualan::find($id)->delete();

        $detail     = PenjualanDetail::where('penjualan_id','=',$id)->get();
        foreach ($detail as $data) {
            $barang = Barang::where('kode_barang','=',$data->kode_barang)->first();
            $barang->stok -= $data->jumlah;
            $barang->update();
            $data->delete();
        }
    }
    
}

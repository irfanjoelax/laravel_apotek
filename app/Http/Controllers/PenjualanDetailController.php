<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Penjualan;
use App\PenjualanDetail;
use App\Barang;
use Yajra\Datatables\Datatables;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        // pengecekan apakah ada transaksi yang sedang berjalan ?
        if (!empty(session('idPenjualan'))) {
            $idPenjualan = session('idPenjualan');
            return view('user.penjualan_detail.index', compact('barangs','idPenjualan'));
        } else {
            return redirect()->route('home');
        }
    }

    public function newSession()
    {
        $penjualan = new Penjualan;

        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->user_id = Auth::user()->id;
        $penjualan->save();

        session(['idPenjualan' => $penjualan->id_penjualan]);
        return redirect()->route('transaksi.index');
    }

    public function data($id)
    {
        $detail = PenjualanDetail::leftJoin('barangs','barangs.kode_barang','=','penjualan_details.kode_barang')
                                        ->where('penjualan_id','=',$id)
                                        ->get();
        $no     = 1;
        $data   = array();
        $total  = 0;
        foreach ($detail as $list) {
            $row    = array();
            $row[]  = $no++;
            $row[]  = $list->kode_barang;
            $row[]  = $list->nama_barang;
            $row[]  = "
                <input type='number' class='form-control' name='jumlah_$list->id_penjualan_detail' id='jumlah' value='$list->jumlah' onChange='changeCount($list->id_penjualan_detail,$list->stok)'>
            ";
            $row[]  = "
                <center>$list->diskon %</center>
            ";
            $row[]  = "Rp. ".format_uang($list->subtotal);
            $row[]  = '
                <a onclick="deleteItem('.$list->id_penjualan_detail.')" class="btn btn-xs btn-danger">hapus</a>
            ';

            $data[] = $row;
            $total  += $list->subtotal;
        }

        // input type hidden untuk perhitungan total
        $data[]     = array(
            "<span class='hide total'>$total</span>","","","","","","","",
        );

        $output     = array("data" => $data);
        return response()->json($output);
    }

    public function saveData(Request $request)
    {
        $data = array(
            'total_harga' => $request['total'],
            'diskon' => $request['diskon'],
            'bayar' => $request['bayar'],
            'diterima' => $request['diterima'],
        );

        Penjualan::find($request['idPenjualan'])->update($data);

        // update data stok sesuai dengan yang dibeli
        $detail = PenjualanDetail::where('penjualan_id','=',$request['idPenjualan'])->get();

        foreach ($detail as $data) {
            $barang = Barang::where('kode_barang','=',$data->kode_barang)->first();
            $barang->stok -= $data->jumlah;
            $barang->update();
        }

        return redirect()->route('transaksi.new')->with('info','Data Penjualan Berhasil Diinput');
    }

    public function loadForm($diskon, $total, $diterima)
    {
        $bayar      = $total - ($diskon / 100 * $total);
        $kembali    = ($diterima != 0) ? $diterima - $bayar : 0;

        $data = array(
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar)) ." Rupiah",
            'kembalirp' => format_uang($kembali),
            'kembaliterbilang' => ucwords(terbilang($kembali)) ." Rupiah",
        );
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $barang = Barang::where('kode_barang','=',$request['kode_barang'])->first();

        PenjualanDetail::create([
            'penjualan_id' => $request['idPenjualan'],
            'kode_barang' => $request['kode_barang'],
            'harga_jual' => $barang['harga_jual'],
            'jumlah' => 1,
            'diskon' => $barang['diskon'],
            //sub total disesuaikan dengan ada atu tidaknya diskon ?
            'subtotal' => $barang['harga_jual'] - ($barang['diskon'] / 100 * $barang['harga_jual']),
        ]);
    }

    public function storeResep(Request $request)
    {
        $barang = Barang::where('kode_barang','=',$request['kode_barang'])->first();

        PenjualanDetail::create([
            'penjualan_id' => $request['idPenjualan'],
            'kode_barang' => $request['kode_barang'],
            'harga_jual' => $barang['harga_resep'],
            'jumlah' => 1,
            'diskon' => $barang['diskon'],
            //sub total disesuaikan dengan ada atu tidaknya diskon ?
            'subtotal' => $barang['harga_resep'] - ($barang['diskon'] / 100 * $barang['harga_resep']),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $nama_input         = "jumlah_".$id;
        $detail             = PenjualanDetail::find($id);

        $total_harga        = $request[$nama_input] * $detail->harga_jual;
        $detail->jumlah     = $request[$nama_input];
        $detail->subtotal   = $total_harga - ($detail->diskon / 100 * $total_harga);
        $detail->update();
    }

    public function destroy($id)
    {
        PenjualanDetail::find($id)->delete();
    }

    public function cancel($id)
    {
        Penjualan::find($id)->delete();

        return redirect()->route('penjualan.index');
    }
}

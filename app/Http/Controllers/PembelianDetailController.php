<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\PembelianDetail;
use App\Barang;
use App\Supplier;
use Yajra\Datatables\Datatables;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $no = 1;
        $barangs        = Barang::all();
        $idPembelian    = session('idPembelian');
        $supplier       = Supplier::find(session('idSupplier'));
        return view('admin.pembelian_detail.index', compact('barangs','idPembelian','supplier','no'));
    }

    public function data($id)
    {
        $detail = PembelianDetail::leftJoin('barangs','barangs.kode_barang','=','pembelian_details.kode_barang')
                                    ->where('pembelian_id', $id)
                                    ->orderBy('id_pembelian_detail','desc')
                                    ->get();

        $no = 1;
        $total = 0;
        $total_item = 0;
        $data = array();

        foreach ($detail as $list) {
            $row = array();
            $row[] = $no++;
            $row[] = $list->kode_barang;
            $row[] = $list->nama_barang;
            $row[] = "
                <input type='number' name='jumlah_$list->id_pembelian_detail' value='$list->jumlah' onChange='changeCount($list->id_pembelian_detail)''>
            ";
            $row[] = '
                <center><a onclick="deleteItem('.$list->id_pembelian_detail.')" class="btn btn-xs btn-danger">hapus</a></center>
            ';
            
            $data[] = $row;
            // $total  += $list->harga_beli * $list->jumlah;
            // $total_item += $list->jumlah;
        }
        // $data[] = array("<span class='hide total'>$total</span><span class='hide totalitem'>$total_item</span>", "", "", "", "", "", "");

        // $output = array("data" => $data);
        // return response()->json($output);
        return datatables::of($data)->escapeColumns([])->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $barang = Barang::where('kode_barang','=',$request['kode_barang'])->first();

        $data = array(
            'pembelian_id' => $request['idPembelian'],
            'kode_barang' => $request['kode_barang'],
            'harga_beli' => $barang['harga_beli'],
            'jumlah' => 1,
            'subtotal' => $barang['harga_beli'],
        );

        PembelianDetail::create($data);
    }

    public function loadForm($diskon,$total)
    {
        $bayar = $total - ($diskon / 100 * $total);

        $data = array(
            'totalrp' => format_uang($total), 
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar))."Rupiah",
        );

        return response()->json($data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $nama_input = "jumlah_".$id;

        $data = array(
            'jumlah' => $request[$nama_input],
        );

        $detail = PembelianDetail::find($id)->update($data);

    }

    public function destroy($id)
    {
        PembelianDetail::find($id)->delete();
    }

    public function cancel($id)
    {
        Pembelian::find($id)->delete();
        PembelianDetail::where('pembelian_id','=',$id)->delete();
        return redirect()->route('pembelian.index');
    }
}

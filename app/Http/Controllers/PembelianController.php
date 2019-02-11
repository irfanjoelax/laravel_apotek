<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\PembelianDetail;
use App\Supplier;
use App\Barang;
use Yajra\Datatables\Datatables;


class PembelianController extends Controller
{
    public function index()
    {
        
        $suppliers  = Supplier::all()->sortByDesc('id_supplier');
        $no         = 1;
        return view('admin.pembelian.index',compact('pembelians','suppliers','no'));
    }

    public function data(){
       $detail  = Pembelian::join('suppliers','suppliers.id_supplier','=','pembelians.supplier_id')
                                    ->orderBy('id_pembelian','DESC')
                                    ->get();
        $no     = 1;
        $data   = array();

        foreach ($detail as $list) {
            $row = array();
            $row[] = $list->no_faktur;
            $row[] = tanggal_indonesia(substr($list->tgl_faktur, 0, 10),false);
            $row[] = $list->nama_supplier;
            $row[] = $list->jenis_faktur;
            $row[] = tanggal_indonesia(substr($list->jatuh_tempo, 0, 10),false);
            $row[] = "Rp. ".format_uang($list->total_beli);
            $row[] = '
                <center>
                    <a href="'.route('pembelian.show',$list->id_pembelian).'" class="btn btn-xs btn-warning"><em class="fa fa-eye"></em> lihat</a>
                    <a onclick="deleteItem('.$list->id_pembelian.')" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em> hapus</a>
                </center>
            ';
            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
    }

    public function create($id)
    {
        $pembelian = new Pembelian;
        $pembelian->supplier_id = $id;
        $pembelian->save();

        session(['idPembelian' => $pembelian->id_pembelian]);
        session(['idSupplier' => $id]);

        return redirect()->route('pembelian_detail.index');
    }

    public function store(Request $request)
    {
        Pembelian::find($request['idPembelian'])->update([
            'no_faktur' => $request['no_faktur'],
            'tgl_faktur' =>$request['tgl_faktur'],
            'jenis_faktur' => $request['jenis_faktur'],
            'jatuh_tempo' =>$request['jatuh_tempo'],
            'total_beli' =>$request['total_beli'],
        ]);

        $detail = PembelianDetail::where('pembelian_id','=',$request['idPembelian'])->get();

        foreach ($detail as $data) {
            $barang = Barang::where('kode_barang','=',$data->kode_barang)->first();

            $barang->stok += $data->jumlah;
            $barang->update();
        }
    }

    public function show($id)
    {
        $no = 1;
        $details    = PembelianDetail::join('pembelians','pembelians.id_pembelian','=','pembelian_details.pembelian_id')
                                    ->join('barangs','barangs.kode_barang','=','pembelian_details.kode_barang')
                                    ->where('pembelian_id','=',$id)
                                    ->get();

        $data       = Pembelian::join('suppliers','pembelians.supplier_id','=','suppliers.id_supplier')
                                    ->find($id);

        return view('admin.pembelian.detail',compact('details','data','no'));
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

        $detail = PembelianDetail::where('pembelian_id','=',$id)->get();

        foreach ($detail as $data) {
            $produk = Barang::where('kode_barang','=',$data->kode_barang)->first();
            $produk->stok -= $data->jumlah;
            $produk->update();
            $data->delete();
        }

        $pembelian = Pembelian::find($id)->delete();

        return redirect()->route('pembelian.index');
    }
}

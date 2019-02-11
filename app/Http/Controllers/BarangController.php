<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Satuan;
use App\Barang;
use Excel;
use PDF;

class BarangController extends Controller
{
    public function index()
    {
        return view('admin.barang.index');
    }

    public function data()
    {
        $barangs = Barang::leftJoin('satuans','satuans.id_satuan','=','barangs.satuan_id')
                            ->orderBy('id_barang','DESC')
                            ->get();

        $data = array();

        foreach ($barangs as $list) {
            $row    = array();

            $row[]  = $list->no_batch;
            $row[]  = $list->nama_barang;
            $row[]  = $list->nama_satuan;
            $row[]  = $list->diskon.' %';
            $row[]  = 'Rp.'.format_uang($list->harga_beli);
            $row[]  = 'Rp.'.format_uang($list->harga_jual);
            $row[]  = 'Rp.'.format_uang($list->harga_resep);
            $row[]  = number_format($list->stok);
            $row[]  = '
                <a href="'.route('barang.edit',$list->id_barang).'" class="btn btn-xs btn-warning"><em class="fa fa-edit"></em></a>
                <a onclick="deleteData('.$list->id_barang.')" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em></a>
            ';

            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
    }

    public function create()
    {
        $maxBarang  = Barang::max('kode_barang');
        $kodeBarang = kode_otomatis($maxBarang,'BRG');
        $satuans    = Satuan::all();
        return view('admin.barang.create',compact('kodeBarang','satuans'));
    }

    public function store(Request $request)
    {
        $data = array(
            'kode_barang' => $request['kode_barang'],
            'no_batch' => $request['no_batch'],
            'nama_barang' => $request['nama_barang'],
            'satuan_id' => $request['satuan_id'],
            'diskon' => $request['diskon'],
            'harga_beli' => $request['harga_beli'],
            'harga_jual' => $request['harga_jual'],
            'harga_resep' => $request['harga_resep'],
            'stok' => $request['stok']
        );

        Barang::create($data);
        return redirect()->route('barang.index')->with('info','Data Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $satuans = Satuan::all();
        $barang  = Barang::find($id);
        return view('admin.barang.edit',compact('barang','satuans'));
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'kode_barang' => $request['kode_barang'],
            'nama_barang' => $request['nama_barang'],
            'satuan_id' => $request['satuan_id'],
            'diskon' => $request['diskon'],
            'harga_beli' => $request['harga_beli'],
            'harga_jual' => $request['harga_jual'],
            'harga_resep' => $request['harga_resep'],
            'stok' => $request['stok']
        );

        Barang::find($id)->update($data);
        return redirect()->route('barang.index')->with('warning','Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Barang::find($id)->delete();
        return redirect()->route('barang.index')->with('danger','Data Berhasil Dihapus');
    }

    public function excelView()
    {
        return view('admin.barang.excel');
    }

    public function exportExcel()
    {
        $barangs = Barang::all()->sortByDesc('id_barang');
        return Excel::create('databarang', function($excel) use ($barangs){
            $excel->sheet('mysheet', function($sheet) use ($barangs){
                $sheet->fromArray($barangs);
            });
        })->download('xls');
    }

    public function importExcel(Request $request)
    {
        if ($request->hasFile('import')) {
            $path = $request->file('import')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $barang = new Barang();
                    $barang->kode_barang = $value->kode_barang;
                    $barang->no_batch = $value->no_batch;
                    $barang->nama_barang = $value->nama_barang;
                    $barang->satuan_id = $value->satuan_id;
                    $barang->diskon = $value->diskon;
                    $barang->harga_beli = $value->harga_beli;
                    $barang->harga_jual = $value->harga_jual;
                    $barang->harga_resep = $value->harga_beli;
                    $barang->stok = $value->stok;
                    $barang->save();
                }
            }
        }

        return redirect()->route('barang.index');
    }

    public function importPdf(){
        set_time_limit(0);
        
        $barangs = Barang::leftJoin('satuans','satuans.id_satuan','=','barangs.satuan_id')
                            ->orderBy('id_barang','DESC')
                            ->get();

        $pdf = PDF::loadView('admin.barang.pdf',compact('barangs'));
        return $pdf->download('barang('.date('Y-m-d').').pdf');
    }

    public function viewPdf()
    {
         $barangs = Barang::leftJoin('satuans','satuans.id_satuan','=','barangs.satuan_id')
                            ->orderBy('id_barang','DESC')
                            ->get();
        return view('admin.barang.pdf', compact('barangs'));
    }
}

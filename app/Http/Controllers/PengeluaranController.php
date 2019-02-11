<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.pengeluaran.index');
    }

     public function data()
    {
        
        $pengeluarans = Pengeluaran::all()->sortByDesc('id_pengeluaran');

        $data = array();

        foreach ($pengeluarans as $pengeluaran) {
            $no = 1;
            $row    = array();

            $row[]  = $no++;
            $row[]  = tanggal_indonesia(substr($pengeluaran->created_at, 0, 10),false);
            $row[]  = $pengeluaran->jenis_pengeluaran;
            $row[]  = "Rp. ".format_uang($pengeluaran->nominal);
            $row[]  = '
                <a href="'.route('pengeluaran.edit',$pengeluaran->id_pengeluaran).'" class="btn btn-xs btn-warning"><em class="fa fa-edit"></em> ubah</a>
                <a onclick="deleteData('.$pengeluaran->id_pengeluaran.')" class="btn btn-xs btn-danger"><em class="fa fa-trash"></em> hapus</a>
            ';

            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'jenis_pengeluaran' => $request['jenis_pengeluaran'],
            'nominal' => $request['nominal'],
        );

        Pengeluaran::create($data);
        return redirect()->route('pengeluaran.index')->with('info','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return view('admin.pengeluaran.edit',compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'jenis_pengeluaran' => $request['jenis_pengeluaran'],
            'nominal' => $request['nominal'],
        );

        Pengeluaran::find($id)->update($data);
        return redirect()->route('pengeluaran.index')->with('warning','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengeluaran::find($id)->delete();
        return redirect()->route('pengeluaran.index')->with('danger','Data Berhasil Dihapus');
    }
}

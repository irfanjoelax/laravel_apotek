<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    
    public function index()
    {
        $no = 1;
        $users = User::all()->sortByDesc('id');
        return view('admin.user.index',compact('no','users'));
    }

   
    public function create()
    {
        return view('admin.user.create');
    }

    
    public function store(Request $request)
    {
        $data = array(
            'name' => $request['name'], 
            'email' => $request['email'], 
            'password' => bcrypt('123456'), 
            'level' => $request['level'], 
        );

        // return dd($data);
        User::create($data);
        return redirect()->route('user.index')->with('info','Data Berhasil Ditambahkan');
    }

    
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        if (empty($request['password'])) {

            $data = array(
                'name' => $request['name'], 
                'email' => $request['email'],
                'level' => $request['level'], 
            );

            User::find($id)->update($data);

        } else {
            $data = array(
                'name' => $request['name'], 
                'email' => $request['email'], 
                'password' => bcrypt($request['password']), 
                'level' => $request['level'], 
            );

            User::find($id)->update($data);
        }
        
        return redirect()->route('user.index')->with('warning','Data Berhasil Diubah');
    }

    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')->with('danger','Data Berhasil Dihapus');
    }

    public function profil()
    {
        $user = Auth::user();
        return view('admin.user.profil',compact('user'));
    }

    public function ubahProfil(Request $request, $id)
    {
        if (empty($request['password'])) {

            $data = array(
                'name' => $request['name'], 
                'email' => $request['email'],
                'level' => $request['level'], 
            );

            User::find($id)->update($data);

        } else {
            $data = array(
                'name' => $request['name'], 
                'email' => $request['email'], 
                'password' => bcrypt($request['password']), 
                'level' => $request['level'], 
            );

            User::find($id)->update($data);
        }
        
        return redirect()->route('home')->with('info','Data Profil Berhasil Diubah');
    }
}

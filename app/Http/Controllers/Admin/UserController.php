<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function indexAdmin()
    {
        $users = User::where('status_admin', true)->get();
        return view('backend.admin.data', compact('users'));
    }

    public function indexUser()
    {
        $pengguna = User::where('status_admin', false)->get();
        return view('backend.pengguna.data', compact('pengguna'));
    }

    // create
    public function create()
    {
        return view('backend.admin.tambah'); 
    }

    public function store(Request $request)
    {
        $data['nama']        = $request->nama;
        $data['email']       = $request->email;
        $data['password']    = Hash::make($request->password);
        $data['no_telepon']  = $request->no_telepon;
        $data['status_admin'] = $request->input('status_admin', false);

        User::create($data);
        
        if ($data['status_admin']) {
            return redirect()->route('admin.backend.admin.data')->with('success', 'Data Admin Berhasil Ditambah!');
        } else {
            return redirect()->route('admin.backend.pengguna.data')->with('success', 'Data Pengguna Berhasil Ditambah!');
        }
    }

    public function edit(Request $request, $id){
        $data = User::find($id);

        return view('backend.admin.edit', compact('data')); 
    }

    public function update(Request $request, $id){
        $data['nama']        = $request->nama;
        $data['email']       = $request->email;
        $data['password']    = Hash::make($request->password);
        $data['no_telepon']  = $request->no_telepon;
        $data['status_admin'] = $request->input('status_admin', false);


        User::whereId($id)->update($data);
        
        if ($data['status_admin']) {
            return redirect()->route('admin.backend.admin.data')->with('success', 'Data Admin Berhasil Diperbarui!');
        } else {
            return redirect()->route('admin.backend.pengguna.data')->with('success', 'Data Pengguna Berhasil Diperbarui!');
        }
    }

    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }
        
        if ($data['status_admin']) {
            return redirect()->route('admin.backend.admin.data')->with('danger', 'Data Admin Berhasil Dihapus!');
        } else {
            return redirect()->route('admin.backend.pengguna.data')->with('danger', 'Data Pengguna Berhasil Dihapus!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index(){

        $pesan = Pemesanan::get();
        return view('backend.pemesanan.pesan', compact('pesan'));
    }

    public function create()
    {
        return view('backend.pemesanan.tambah'); 
    }

    public function store(Request $request)
    {

        $user = Auth::user();

         // Tentukan biaya kebersihan
         $biaya_kebersihan = $request->jumlah_peserta < 100 ? 100000 : 150000;

         // Tentukan biaya berdasarkan jenis pemesanan
         $biaya_pemesanan = $request->jenis_pemesanan == 'penyewaan' ? 670000 : 0;
 
         // Hitung total biaya
         $total_biaya = $biaya_kebersihan + $biaya_pemesanan;

        $pesan['nama']                = $request->nama;
        $pesan['unit_atau_instansi']  = $request->unit_atau_instansi;
        $pesan['nama_kegiatan']       = $request->nama_kegiatan;
        $pesan['tanggal_pemakaian']   = $request->tanggal_pemakaian;
        $pesan['jumlah_peserta']      = $request->jumlah_peserta;
        $pesan['jenis_pemesanan']     = $request->jenis_pemesanan;
        $pesan['total_biaya']         = $total_biaya;
        $pesan['keterangan']          = $request->keterangan;
        $pesan['user_id']             = $user->id;

        // Simpan data ke database
        Pemesanan::create($pesan);
        
        return redirect()->route('admin.backend.pemesanan.pesan')->with('success', 'Data Pemesanan Berhasil Ditambah!');
    }

    public function edit(Request $request, $id){

        $pesan = Pemesanan::find($id);

        return view('backend.pemesanan.edit', compact('pesan')); 
    }

    public function update(Request $request, $id){

        $user = Auth::user();

         // Tentukan biaya kebersihan
         $biaya_kebersihan = $request->jumlah_peserta < 100 ? 100000 : 150000;

         // Tentukan biaya berdasarkan jenis pemesanan
         $biaya_pemesanan = $request->jenis_pemesanan == 'penyewaan' ? 670000 : 0;
 
         // Hitung total biaya
         $total_biaya = $biaya_kebersihan + $biaya_pemesanan;

        $pesan['nama']                = $request->nama;
        $pesan['unit_atau_instansi']  = $request->unit_atau_instansi;
        $pesan['nama_kegiatan']       = $request->nama_kegiatan;
        $pesan['tanggal_pemakaian']   = $request->tanggal_pemakaian;
        $pesan['jumlah_peserta']      = $request->jumlah_peserta;
        $pesan['jenis_pemesanan']     = $request->jenis_pemesanan;
        $pesan['total_biaya']         = $total_biaya;
        $pesan['keterangan']          = $request->keterangan;
        $pesan['user_id']             = $user->id;


        Pemesanan::whereId($id)->update($pesan);
        
        return redirect()->route('admin.backend.pemesanan.pesan')->with('success', 'Data Pemesanan Berhasil Diperbarui!');
    }

    public function delete(Request $request, $id){
        $data = Pemesanan::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.backend.pemesanan.pesan')->with('danger', 'Data Pemesanan Berhasil Dihapus!');
    }

    public function updateStatus(Request $request, $id){

        $pemesanan = Pemesanan::find($id);

        if ($pemesanan) {
            $pemesanan->status_konfirmasi = $request->status_konfirmasi;
            $pemesanan->save();
            return redirect()->route('admin.backend.pemesanan.pesan')->with('success', 'Status Pemesanan Berhasil Diubah!');
        }
            return redirect()->route('admin.backend.pemesanan.pesan')->with('error', 'Gagal Mengubah Status Pemesanan!');
    }
}

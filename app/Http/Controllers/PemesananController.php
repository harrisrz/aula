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

        $request->validate([
            'nama' => 'required|string|max:255',
            'unit_atau_instansi' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jumlah_peserta' => 'required|integer|min:1',
            'jenis_pemesanan' => 'required|string|in:penyewaan,peminjaman',
            'keterangan' => 'nullable|string',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'unit_atau_instansi.required' => 'Unit atau instansi harus diisi.',
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi.',
            'jumlah_peserta.required' => 'Jumlah peserta harus diisi.',
            'jumlah_peserta.integer' => 'Jumlah peserta harus berupa angka.',
            'jumlah_peserta.min' => 'Jumlah peserta harus minimal 1.',
        ]);
    
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
        $pesan['tanggal_mulai']       = $request->tanggal_mulai;
        $pesan['tanggal_selesai']     = $request->tanggal_selesai;
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

        $request->validate([
            'nama' => 'required|string|max:255',
            'unit_atau_instansi' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jumlah_peserta' => 'required|integer|min:1',
            'jenis_pemesanan' => 'required|string|in:penyewaan,peminjaman',
            'keterangan' => 'nullable|string',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'unit_atau_instansi.required' => 'Unit atau instansi harus diisi.',
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi.',
            'jumlah_peserta.required' => 'Jumlah peserta harus diisi.',
            'jumlah_peserta.integer' => 'Jumlah peserta harus berupa angka.',
            'jumlah_peserta.min' => 'Jumlah peserta harus minimal 1.',
        ]);

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
        $pesan['tanggal_mulai']       = $request->tanggal_mulai;
        $pesan['tanggal_selesai']     = $request->tanggal_selesai;
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

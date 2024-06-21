<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(){

        $bayar = Pembayaran::get();
        return view('backend.pembayaran.bayar', compact('bayar'));
    }

    public function create($id_pemesanan)
    {
        $pesan = Pemesanan::find($id_pemesanan);

        return view('backend.pembayaran.tambah', compact('pesan')); 
    }

    public function store(Request $request)
    {

        $bayar['tanggal_pembayaran'] = $request->tanggal_pembayaran;
        $bayar['metode_pembayaran']  = $request->metode_pembayaran;
        $bayar['nominal_biaya']      = $request->nominal_biaya;
        $bayar['pembayaran_ke']      = $request->pembayaran_ke;
        $bayar['keterangan']         = $request->keterangan;
        $bayar['id_pemesanan']       = $request->id_pemesanan;

        // Simpan data ke database
        Pembayaran::create($bayar);

        // Cari data pemesanan yang sesuai dengan id_pemesanan
        $pesan = Pemesanan::find($request->id_pemesanan);

        // Periksa nilai keterangan dan perbarui status pembayaran pada tabel pemesanan
        if ($request->keterangan == 'cicilan') {
            $pesan->status_pembayaran = 'belum_lunas';
        } elseif ($request->keterangan == 'lunas') {
            $pesan->status_pembayaran = 'lunas';
        }

        // Simpan perubahan pada tabel pemesanan
        $pesan->save();
        
        return redirect()->route('admin.backend.pembayaran.bayar')->with('success', 'Data Pembayaran Berhasil Ditambah!');
    }

    public function edit(Request $request, $id){

        $bayar = Pembayaran::find($id);

        return view('backend.pembayaran.edit', compact('bayar')); 
    }

    public function update(Request $request, $id){

        $bayar['tanggal_pembayaran'] = $request->tanggal_pembayaran;
        $bayar['metode_pembayaran']  = $request->metode_pembayaran;
        $bayar['nominal_biaya']      = $request->nominal_biaya;
        $bayar['pembayaran_ke']      = $request->pembayaran_ke;
        $bayar['keterangan']         = $request->keterangan;
        $bayar['id_pemesanan']       = $request->id_pemesanan;

        Pembayaran::whereId($id)->update($bayar);
        
        return redirect()->route('admin.backend.pembayaran.bayar')->with('success', 'Data Pembayaran Berhasil Diperbarui!');
    }

    public function delete(Request $request, $id){
        $data = Pembayaran::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.backend.pembayaran.bayar')->with('danger', 'Data Pembayaran Berhasil Dihapus!');
    }
}

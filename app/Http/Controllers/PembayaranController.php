<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'tanggal_pembayaran' => 'required|date|after_or_equal:today',
            'metode_pembayaran' => 'required|string|max:255',
            'nominal_biaya' => 'required|numeric|min:0',
            'pembayaran_ke' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'tanggal_pembayaran.required' => 'Tanggal pembayaran harus diisi.',
            'tanggal_pembayaran.after_or_equal' => 'Tanggal pembayaran harus sama atau setelah hari ini.',
            'nominal_biaya.required' => 'Nominal biaya harus diisi.',
            'pembayaran_ke.required' => 'Pembayaran ke- harus diisi.',
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diunggah.',
            'bukti_pembayaran.file' => 'Bukti pembayaran harus berupa file.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format jpeg, png, jpg, atau pdf.',
            'bukti_pembayaran.max' => 'Ukuran bukti pembayaran maksimal adalah 2MB.',
        ]);

        $bayar = [
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'nominal_biaya' => $request->nominal_biaya,
            'pembayaran_ke' => $request->pembayaran_ke,
            'keterangan' => $request->keterangan,
            'id_pemesanan' => $request->id_pemesanan
        ];

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');
            $bayar['bukti_pembayaran'] = $path;
        }
        
        // Simpan data ke database
        Pembayaran::create($bayar);

        return redirect()->route('admin.backend.pembayaran.bayar')->with('success', 'Data Pembayaran Berhasil Ditambah!');
    }

    public function edit(Request $request, $id){

        $bayar = Pembayaran::find($id);

        return view('backend.pembayaran.edit', compact('bayar')); 
    }

    public function update(Request $request, $id){

        $request->validate([
            'tanggal_pembayaran' => 'required|date|after_or_equal:today',
            'metode_pembayaran' => 'required|string|max:255',
            'nominal_biaya' => 'required|numeric|min:0',
            'pembayaran_ke' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'tanggal_pembayaran.required' => 'Tanggal pembayaran harus diisi.',
            'tanggal_pembayaran.after_or_equal' => 'Tanggal pembayaran harus sama atau setelah hari ini.',
            'nominal_biaya.required' => 'Nominal biaya harus diisi.',
            'pembayaran_ke.required' => 'Pembayaran ke- harus diisi.',
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diunggah.',
            'bukti_pembayaran.file' => 'Bukti pembayaran harus berupa file.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format jpeg, png, jpg, atau pdf.',
            'bukti_pembayaran.max' => 'Ukuran bukti pembayaran maksimal adalah 2MB.',
        ]);

        $bayar = [
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'nominal_biaya' => $request->nominal_biaya,
            'pembayaran_ke' => $request->pembayaran_ke,
            'keterangan' => $request->keterangan,
            'id_pemesanan' => $request->id_pemesanan
        ];

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');
            $bayar['bukti_pembayaran'] = $path;
        }
        
        Pembayaran::whereId($id)->update($bayar);
        
        return redirect()->route('admin.backend.pembayaran.bayar')->with('success', 'Data Pembayaran Berhasil Diperbarui!');
    }

   public function delete(Request $request, $id)
{
    $data = Pembayaran::find($id);

    if ($data) {
        $pesan = Pemesanan::find($data->id_pemesanan);

        // Hapus bukti pembayaran dari storage jika ada
        if ($data->bukti_pembayaran) {
            Storage::disk('public')->delete($data->bukti_pembayaran);
        }

        // Hapus data pembayaran
        $data->delete();

        // Perbarui status pembayaran pada tabel pemesanan
        // Cek apakah masih ada pembayaran untuk pemesanan ini
        $remainingPayments = Pembayaran::where('id_pemesanan', $pesan->id)->get();

        if ($remainingPayments->isEmpty()) {
            $pesan->status_pembayaran = 'belum_bayar';
        } else {
            // Periksa apakah ada pembayaran dengan status 'lunas'
            $statusLunas = $remainingPayments->contains(function ($payment) {
                return $payment->keterangan == 'lunas' && $payment->status_konfirmasi === 'disetujui';
            });

            if ($statusLunas) {
                $pesan->status_pembayaran = 'lunas';
            } else {
                $pesan->status_pembayaran = 'belum_lunas';
            }
        }

        // Simpan perubahan status pembayaran
        $pesan->save();

        return redirect()->route('admin.backend.pembayaran.bayar')->with('danger', 'Data Pembayaran Berhasil Dihapus!');
    }

    return redirect()->route('admin.backend.pembayaran.bayar')->with('error', 'Gagal Menghapus Data Pembayaran!');
}


    public function updateStatus(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);

        if ($pembayaran) {
            $pesan = Pemesanan::find($pembayaran->id_pemesanan);

            // Perbarui status konfirmasi pembayaran
            $pembayaran->status_konfirmasi = $request->status_konfirmasi;
            $pembayaran->keterangan = $request->keterangan ?? $pembayaran->keterangan; // Perbarui keterangan pembayaran
            $pembayaran->save();

            // Perbarui status pembayaran pada tabel pemesanan
            if ($pembayaran->status_konfirmasi === 'disetujui') {
                // Update status pembayaran berdasarkan keterangan
                if ($pembayaran->keterangan == 'cicilan') {
                    $pesan->status_pembayaran = 'belum_lunas';
                } elseif ($pembayaran->keterangan == 'lunas') {
                    $pesan->status_pembayaran = 'lunas';
                }
            } else {
                $pesan->status_pembayaran = 'belum_bayar';
            }

            // Simpan perubahan status pembayaran
            $pesan->save();

            return redirect()->route('admin.backend.pembayaran.bayar')->with('success', 'Status Pembayaran Berhasil Diubah!');
        }

        return redirect()->route('admin.backend.pembayaran.bayar')->with('error', 'Gagal Mengubah Status Pembayaran!');
    }

}

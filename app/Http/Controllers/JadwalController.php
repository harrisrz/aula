<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    //
    public function index()
    {
        return view('frontend.jadwal');
    }

    public function list(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $color = '#006400';
        $bgcolor = '#006400';

        $pemesanan = Pemesanan::where('tanggal_mulai', '>=', $start)
        ->where('tanggal_selesai', '<=', $end)
        ->where('status_konfirmasi', 'disetujui')
        ->get()
        ->map( fn ($item) => [
            'id' => $item->id,
            'title' => $item->nama_kegiatan,
            'start' => $item->tanggal_mulai,
            'end' => $item->tanggal_selesai,
            'color' => $color,
            'borderColor' => $bgcolor
        ]);

        return response()->json($pemesanan);
    }

    public function create(Request $request)
    {
        $tanggal = $request->get('date');
        return view('frontend.form-pesanan', compact('tanggal'));
    }

    public function getPesananByDate(Request $request)
    {
        $tanggal = $request->date;
        $pemesanan = Pemesanan::whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('tanggal_selesai', '>=', $tanggal)
            ->get(['nama_kegiatan', 
                   'tanggal_mulai', 
                   'tanggal_selesai', 
                   'status_konfirmasi', 
                   'status_pembayaran', 
                   'id', 
                   'user_id', 
                   'total_biaya']);

        return response()->json($pemesanan);
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

        return redirect()->route('frontend.jadwal')->with('success', 'Pemesanan Berhasil!');
    }

    public function formBayar(Request $request)
    {
        $id = $request->query('id');
        $pemesanan = Pemesanan::find($id);

        return view('frontend.form-bayar', compact('pemesanan'));
    }

    public function bayar(Request $request)
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

        // Cari data pemesanan yang sesuai dengan id_pemesanan
        $pesan = Pemesanan::find($request->id_pemesanan);

        

        // Simpan perubahan pada tabel pemesanan
        $pesan->save();
        
        return redirect()->route('frontend.jadwal')->with('success', 'Catat Pembayaran Berhasil!');
    }
}

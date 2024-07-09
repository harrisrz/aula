<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'nama',
        'user_id',
        'unit_atau_instansi',
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_peserta',
        'jenis_pemesanan',
        'total_biaya',
        'status_konfirmasi',
        'status_pembayaran',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pemesanan');
    }

}

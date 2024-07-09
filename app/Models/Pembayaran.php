<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id_pemesanan',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'nominal_biaya',
        'pembayaran_ke',
        'status_konfirmasi',
        'keterangan',
        'bukti_pembayaran',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('unit_atau_instansi');
            $table->string('nama_kegiatan');
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_selesai');
            $table->integer('jumlah_peserta');
            $table->enum('jenis_pemesanan', ['penyewaan', 'peminjaman']);
            $table->decimal('total_biaya', 10, 2)->default(0.00);
            $table->enum('status_konfirmasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->enum('status_pembayaran', ['belum_bayar', 'belum_lunas', 'lunas'])->default('belum_bayar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};

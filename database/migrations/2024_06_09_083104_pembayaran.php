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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan')->constrained('pemesanan')->onDelete('cascade');
            $table->datetime('tanggal_pembayaran');
            $table->enum('metode_pembayaran', ['cash', 'transfer']);
            $table->decimal('nominal_biaya', 10, 2)->default(0.00);
            $table->integer('pembayaran_ke');
            $table->enum('keterangan', ['lunas', 'cicilan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

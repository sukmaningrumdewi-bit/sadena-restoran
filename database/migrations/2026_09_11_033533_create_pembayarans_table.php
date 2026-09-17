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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran'); // Primary Key kustom
            
            // Foreign Key ke tabel pesanans (pesanan_id)
            // Menghubungkan ke kolom id_pesanan pada tabel pesanans
            $table->foreignId('pesanan_id')->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
            
            $table->string('status'); // Contoh: 'pending', 'sukses', 'gagal'
            $table->string('metode_pembayaran'); // Contoh: 'transfer_bank', 'qris', 'tunai'
            $table->string('bukti_pembayaran')->nullable(); // Menyimpan path/nama file foto bukti bayar (bisa kosong jika belum bayar)
            $table->timestamp('waktu_bayar')->nullable(); // Waktu pembayaran dilakukan (bisa kosong jika belum bayar)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};

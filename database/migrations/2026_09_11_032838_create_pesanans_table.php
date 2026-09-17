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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan'); // Primary Key kustom
            
            // Foreign Key ke tabel users (user_id)
            // Menggunakan constrained('users', 'id') karena tabel users menggunakan id bawaan
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            
            // Foreign Key ke tabel mejas (meja_id)
            // Karena Primary Key tabel mejas adalah 'id_meja', kita definisikan secara spesifik
            $table->foreignId('meja_id')->constrained('mejas', 'id_meja')->onDelete('cascade');
            
            $table->string('status_pesanan'); // Contoh: 'pending', 'diproses', 'selesai', 'dibatalkan'
            $table->decimal('total_harga', 10, 2); // Menggunakan decimal agar akurat untuk nilai uang
            $table->string('tipe_pesanan'); // Contoh: 'dine-in', 'take-away'
            $table->timestamp('waktu_pesanan')->useCurrent(); // Waktu pemesanan (otomatis waktu saat ini)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

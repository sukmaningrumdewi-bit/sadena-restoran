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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id('id_detail_pesanan'); // Primary Key kustom
            
            // Foreign Key ke tabel pesanans (pesanan_id)
            $table->foreignId('pesanan_id')->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
            
            // Foreign Key ke tabel menus (menu_id)
            $table->foreignId('menu_id')->constrained('menus', 'id_menu')->onDelete('cascade');
            
            $table->integer('jumlah'); // Jumlah item/porsi yang dipesan
            $table->decimal('harga_satuan', 10, 2); // Harga menu saat dipesan
            $table->decimal('subtotal', 10, 2); // Hasil kali jumlah x harga_satuan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detai_pesanans');
    }
};

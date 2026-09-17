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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu'); // Primary Key kustom
            $table->string('nama_menu'); // Nama menu makanan/minuman
            $table->decimal('harga', 10, 2); // Harga menu (menggunakan decimal agar presisi)
            $table->string('kategori'); // Contoh kategori: 'makanan', 'minuman', 'dessert'
            $table->boolean('is_active')->default(true); // Status aktif/tidak (true/false atau 1/0)
            $table->string('gambar')->nullable(); // Path atau nama file gambar menu
            $table->text('deskripsi')->nullable(); // Deskripsi lengkap menu
            $table->integer('stok')->default(0); // Jumlah stok menu yang tersedia
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

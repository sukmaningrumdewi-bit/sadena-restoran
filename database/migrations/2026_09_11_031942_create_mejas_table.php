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
        Schema::create('mejas', function (Blueprint $table) {
            $table->id('id_meja'); // Membuat id_meja sebagai Primary Key otomatis (auto-increment)
            $table->string('status'); // Contoh status: 'tersedia', 'terisi', 'dipesan', dll.
            $table->integer('nomer_meja'); // Nomor meja
            $table->integer('kapasitas'); // Kapasitas kursi per meja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};

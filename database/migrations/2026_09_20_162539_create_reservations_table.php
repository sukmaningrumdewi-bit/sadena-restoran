<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kode_reservasi')->unique();
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('jumlah_orang');
            $table->string('area');
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
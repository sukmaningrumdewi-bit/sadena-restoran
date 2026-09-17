<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'user_id',
        'meja_id',
        'status_pesanan',
        'total_harga',
        'tipe_pesanan',
        'waktu_pesanan',
    ];

    // Relasi ke tabel User (Pembeli/Admin yang memesan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke tabel Meja
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id', 'id_meja');
    }
    public function pembayaran()
{
    return $this->hasOne(Pembayaran::class, 'pesanan_id', 'id_pesanan');
}
public function detailPesanans()
{
    return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'id_pesanan');
}
}

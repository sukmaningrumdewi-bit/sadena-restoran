<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'harga',
        'kategori',
        'is_active',
        'gambar',
        'deskripsi',
        'stok',
    ];
    public function detailPesanans()
{
    return $this->hasMany(DetailPesanan::class, 'menu_id', 'id_menu');
}
}

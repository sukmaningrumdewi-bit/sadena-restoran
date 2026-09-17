<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'mejas';       // Nama tabel di database
    protected $primaryKey = 'id_meja'; // Primary Key kustom Anda

    protected $fillable = [
        'status',
        'nomer_meja',
        'kapasitas',
    ];
    public function pesanans() {
    return $this->hasMany(Pesanan::class, 'meja_id', 'id_meja');
}
}

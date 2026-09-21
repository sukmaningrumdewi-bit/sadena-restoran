<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_reservasi',
        'tanggal',
        'waktu',
        'jumlah_orang',
        'area',
        'catatan',
        'status',
    ];

    public function user()
    {
        return $table = $this->belongsTo(User::class);
    }
}
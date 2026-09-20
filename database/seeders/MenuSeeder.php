<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            // --- HIDANGAN UTAMA ---
            [
                'nama_menu' => 'Nasi Goreng Spesial',
                'harga'     => 35000,
                'kategori'  => 'Hidangan Utama',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Nasi goreng gurih dengan telur mata sapi, ayam suwir, dan kerupuk.',
                'stok'      => 50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nama_menu' => 'Ayam Bakar Madu',
                'harga'     => 28000,
                'kategori'  => 'Hidangan Utama',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Ayam bakar manis gurih dengan olesan madu murni dan sambal terasi.',
                'stok'      => 30,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],

            // --- SAJIAN BERKUAH ---
            [
                'nama_menu' => 'Soto Ayam Lamongan',
                'harga'     => 20000,
                'kategori'  => 'Sajian Berkuah',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Soto kuah kuning segar dengan koya gurih ekstra.',
                'stok'      => 40,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nama_menu' => 'Bakso Urat Spesial',
                'harga'     => 25000,
                'kategori'  => 'Sajian Berkuah',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Bakso sapi asli dengan urat melimpah dan kuah kaldu sapi pekat.',
                'stok'      => 25,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],

            // --- PENCUCI MULUT ---
            [
                'nama_menu' => 'Pudding Cokelat Lumer',
                'harga'     => 15000,
                'kategori'  => 'Pencuci Mulut',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Pudding manis dengan saus vla vanila lembut.',
                'stok'      => 20,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nama_menu' => 'Es Krim Matcha',
                'harga'     => 18000,
                'kategori'  => 'Pencuci Mulut',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Es krim rasa teh hijau otentik dengan topping kacang merah.',
                'stok'      => 15,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],

            // --- MINUMAN SEGAR ---
            [
                'nama_menu' => 'Es Teh Manis',
                'harga'     => 8000,
                'kategori'  => 'Minuman Segar',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Es teh melati murni dengan manis gula batu.',
                'stok'      => 100,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nama_menu' => 'Es Kopi Susu Aren',
                'harga'     => 22000,
                'kategori'  => 'Minuman Segar',
                'is_active' => 1,
                'gambar'    => null,
                'deskripsi' => 'Perpaduan espresso, susu krimi, dan manisnya gula aren asli.',
                'stok'      => 45,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
        ];

        DB::table('menus')->insert($menus);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Memanggil seeder menu yang baru saja kita buat
        $this->call([
            MenuSeeder::class,
        ]);
    }
}
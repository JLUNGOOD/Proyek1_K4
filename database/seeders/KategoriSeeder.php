<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            ['name' => 'Kualitas Air'],
            ['name' => 'Kehilangan Pasokan Air'],
            ['name' => 'Tagihan yang Tidak Sesuai'],
            ['name' => 'Pelayanan Pelanggan'],
            ['name' => 'Pemasangan atau Perbaikan Meteran Air'],
            ['name' => 'Kebocoran Saluran Air'],
            ['name' => 'Pelayanan Tidak Terjangkau']
        ]);
    }
}

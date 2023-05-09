<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengaduan')->insert([
            [
                'user_id' => '01',
                'judul' => 'Air Keruh',
                'isi' => 'Pada Siang hari saat saya mau memasak air tiba-tiba air yang akan kami gunakan menjadi keruh',
                'tanggal_kejadian' => '2023-05-12',
                'bukti_gambar' => '',
                'is_read' => '0',
            ],
            [
                'user_id' => '002',
                'judul' => 'Air Mati',
                'isi' => 'Pada Siang hari saat saya mau memasak air tiba-tiba air yang akan kami gunakan mati',
                'tanggal_kejadian' => '2023-07-12',
                'bukti_gambar' => '',
                'is_read' => '1',
            ]
        ]);
    }
}

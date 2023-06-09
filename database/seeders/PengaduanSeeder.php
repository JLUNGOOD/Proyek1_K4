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
                'kategori_id' => '1',
                'user_id' => '1',
                'judul' => 'Air Keruh',
                'alamat' => 'Lowokwaru',
                'isi' => 'Pada Siang hari saat saya mau memasak air tiba-tiba air yang akan kami gunakan menjadi keruh',
                'tanggal_kejadian' => '2023-05-12',
                'bukti_gambar' => '',
                'is_read' => '0',
            ],
            [
                'kategori_id' => '2',
                'user_id' => '2',
                'judul' => 'Air Mati',
                'alamat' => 'Lowokwaru',
                'isi' => 'Pada Siang hari saat saya mau memasak air tiba-tiba air yang akan kami gunakan mati',
                'tanggal_kejadian' => '2023-07-12',
                'bukti_gambar' => '',
                'is_read' => '1',
            ],
            [
                'kategori_id' => '6',
                'user_id' => '1',
                'judul' => 'Pipa Bocor',
                'alamat' => 'Lowokwaru',
                'isi' => 'Air tiba-tiba keluar dari pipa yang mengalami kebocoran',
                'tanggal_kejadian' => '2023-02-09',
                'bukti_gambar' => '',
                'is_read' => '1',
            ],
            [
                'kategori_id' => '2',
                'user_id' => '2',
                'judul' => 'Air Tersumbat',
                'alamat' => 'Lowokwaru',
                'isi' => 'Saluran air yang ada dibelakang rumah saya mengalami penyumbatan dan air tidak bisa mengalir',
                'tanggal_kejadian' => '2023-02-22',
                'bukti_gambar' => '',
                'is_read' => '1',
            ],
            [
                'kategori_id' => '2',
                'user_id' => '1',
                'judul' => 'Aliran Air Kecil',
                'alamat' => 'Lowokwaru',
                'isi' => 'Aliran air dirumah saya sangat kecil, Sehingga aktivitas dirumah saya terganggu',
                'tanggal_kejadian' => '2023-04-19',
                'bukti_gambar' => '',
                'is_read' => '1',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatan')->insert([
            [
                'user_id' => '1',
                'judul_kegiatan' => 'Pembersihan air yang keruh',
                'slug' => 'pembersihan-air-yang-keruh',
                'isi_kegiatan' => 'Kegiatan pembersihan dilakukan oleh petugas pada konsumen yang mengalami air keruh',
                'tanggal_kegiatan' => '2023-01-15'
            ],
            [
                'user_id' => '2',
                'judul_kegiatan' => 'Memperbaiki air yang  mati',
                'slug' => 'memperbaiki-air-yang-mati',
                'isi_kegiatan' =>'Kegiatan dimulai dengan kegiatan mendatangi konsumen PDAM yang melakukan pengaduan',
                'tanggal_kegiatan' => '2022-08-22'
            ],
            [
                'user_id' => '1',
                'judul_kegiatan' => 'Pembersihan Saluran yang bocor',
                'slug' => 'pembersihan-saluran-yang-bocor',
                'isi_kegiatan' => 'Memperbaiki pipa air yang bocor pada konsumen pdam',
                'tanggal_kegiatan' => '2022-03-02'
            ],
            [
                'user_id' => '2',
                'judul_kegiatan' => 'Memperbaiki air tersumbat',
                'slug' => 'memperbaiki-air-yang-tersumbat',
                'isi_kegiatan' => 'Kegiatan dilakukan dengan memperbaiki saluran yang tersumbat pada rumah masyarakt ',
                'tanggal_kegiatan' => '2022-03-12'
            ],
            [
                'user_id' => '1',
                'judul_kegiatan' => 'Memperbaiki aliran air',
                'slug' => 'memperbaiki-aliran-air',
                'isi_kegiatan' => 'Petugas pdam memperbaiki aliran air yang tersumbat',
                'tanggal_kegiatan' => '2022-04-22'
            ],
        ]);
    }
}

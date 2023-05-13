<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informasi')->insert([
            [
                'user_id' => '1',
                'judul_informasi' => 'Informasi satu',
                'isi_informasi' => 'Informasi hari pertama dalam pengerjaan'
            ],
            [
                'user_id' => '2',
                'judul_informasi' => 'Informasi dua',
                'isi_informasi' => 'Informasi hari kedua dalam pengerjaan'
            ],
            [
                'user_id' => '1',
                'judul_informasi' => 'Informasi tiga',
                'isi_informasi' => 'Informasi hari ketiga dalam pengerjaan'
            ],
            [
                'user_id' => '2',
                'judul_informasi' => 'Informasi empat',
                'isi_informasi' => 'Informasi hari keempet dalam pengerjaan'
            ],
            [
                'user_id' => '1',
                'judul_informasi' => 'Informasi lima',
                'isi_informasi' => 'Informasi hari kelima dalam pengerjaan'
            ]
        ]);
    }
}
